<?php

use Illuminate\Support\Facades\Session;

function front():string
{
    return env('FRONT_THEME_FOLDER').'.';
}


function printCategories($categories, $type = 'option', $prefix = '', $selected = 0)
{

//    $html = '';

    foreach ($categories as $category) {
        if ($type == 'option') {
            $s = ($category->id == $selected) ? " selected " : "";
            echo '<option' . $s . ' value="' . $category->id . '">' . $prefix . $category->name . '</option>';
        } elseif ($type == 'table') {
            $class = ($prefix != '') ? 'pl-4' : '';
            echo '<tr><td class="' . $class . '">' . $prefix . $category->name . '</td><td>' . view("admin.products.categories.actions", ['productCategory' => $category]) . '</td></tr>';
        } elseif ($type == 'table-chars') {
            $class = ($prefix != '') ? 'pl-4' : '';
            echo '<tr><td class="' . $class . '">' . $prefix . $category->name . '</td><td>' . $category->chars()->count() . '</td><td><a href="' . route('admin.products.chars.index', ['category_id' => $category->id]) . '" class="btn btn-primary"><i class="fa fa-eye"></i></a></td></tr>';
        } else {
            echo $prefix . $category->name . "\n";
        }
//        $subcategories = \App\Models\ProductCategory::where('parent_id', $category->id)->get();
        $subcategories = $category->subProductCategories()->get();
        if ($subcategories->count() > 0) {
            printCategories($subcategories, $type, $prefix . '--', $selected);
        }
    }

//    dd($html);
//    return $html;
}


function getValue($key)
{
    $keys = \App\Models\Key::select(['name', 'key', 'value'])->get();
    return $keys->where('key', $key)->first()?->value;
}

function getSecondValue($key)
{
    $keys = \App\Models\Key::select(['name', 'key', 'value_2'])->get();
    return $keys->where('key', $key)->first()?->value_2;
}

function getLabel($label)
{
    if($label == 1){
        return [
            'name'=>'Распродажа',
            'class'=>'hot'
        ];
    }elseif($label == 2){
        return [
            'name'=>'Хит',
            'class'=>'sale'
        ];
    }elseif($label == 3){
        return [
            'name'=>'Новинка',
            'class'=>'new'
        ];
    }
}

function getCartCountTotal()
{
    return (auth()->check()) ? auth()->user()->carts()->count() : \Cart::getContent()->count();
}

function getCartTotal($coupon = null)
{
    if(auth()->check()){
        $value = auth()->user()->getUserCartTotal();
    }else{
        $value = \Cart::getTotal();
    }

    if ($coupon) {
        if ($coupon->type == 0) {
            $discount = (float)$coupon->coupon_amount / 100;
            $value = $value - ($value * $discount);
        } elseif ($coupon->type == 1) {
            $v = $value - $coupon->coupon_amount;
            $value = ($v > 0) ? $v : $value;
        }
    }

    return ceil($value);

}

function orderStatuses($status)
{
    $statuses = [
        '0'  => 'Заказ создан',
        '1'  => 'На сборке',
        '2'  => 'На доставке',
        '3'  => 'Отменен',
        '4'  => 'Завершен',
        '5'  => 'Ожидает оплату',
        '6'  => 'Ошибка оплаты',
    ];

    return $statuses[$status];
}

function getChar($id)
{
    return \App\Models\CharValue::find($id)->char;
}

function getCategory($id)
{
    return \App\Models\ProductCategory::find($id);
}


function convertSizeText($text)
{

    $text = preg_replace('/ мм/', '', $text);

    $text = preg_replace_callback('/(\d+)/', function($matches) {
        return intval($matches[0]) / 10;
    }, $text);

    echo $text;

}

function getActiveCoupon()
{
    if (auth()->check()) return \auth()->user()?->getActiveCoupon?->first();
    $coupon =  \App\Models\Coupon::find(Session::get('coupon'));

    if ($coupon && $coupon->status == 1 && $coupon->available_until > now()){
        return  $coupon;
    }
    return null;
}

function calculateDiscountedPrice($value, $coupon = null)
{
    if (!$coupon) return $value;

    if ($coupon->type == 0) {
        $discount = (float)$coupon->coupon_amount / 100;
        $value = $value - ($value * $discount);
    } elseif ($coupon->type == 1) {
        $v = $value - $coupon->coupon_amount;
        $value = ($v > 0) ? $v : $value;
    }

    return $value;
}
