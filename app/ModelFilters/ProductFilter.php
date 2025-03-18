<?php 

namespace App\ModelFilters;

use App\Models\Char;
use App\Models\Product;
use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\DB;

class ProductFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];


    public function brands($value){
        return $this->whereIn('brand_id', $value);
    }

    public function price($price){
        $min = (int) str_replace(',', '', $price['min']);
        $max = (int) str_replace(',', '', $price['max']);

        $this->whereBetween('price', [$min, $max]);
    }

    public function filters($filters){

        foreach ($filters as $key => $value){
            $filter = Char::where('slug', $key)->first();
            if (!$filter) continue;

            if ($filter->type == 1) {
                $min = (int) str_replace(',', '', $value['min-value'] ?? 0);
                $max = (int) str_replace(',', '', $value['max-value'] ?? 0);
                $this->where(function ($query) use ($filter, $max, $min) {
                    $query->whereJsonContains('chars', [['name' => $filter->name]])
                        ->whereBetween(
                            DB::raw("CAST(chars->0->>'value' AS NUMERIC)"),
                            [$min, $max]
                        );
//                    $query->whereJsonContains('chars', [['name' => $filter->name]])
//                        ->whereBetween(DB::raw("JSON_EXTRACT(chars, '$[0].value')"), [$min, $max]);
                });

            } elseif ($filter->type == 0){
                $this->where(function ($query) use ($value, $filter) {
                    foreach ($value as $val) {
                        $query->OrwhereJsonContains('chars', [['name' => $filter->name, 'value' => $val]]);
                    }
                });
            }
        }
    }
}
