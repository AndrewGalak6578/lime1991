<?php

namespace App\Imports\Admin;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Spatie\MediaLibrary\MediaCollections\Exceptions\UnreachableUrl;


class UpdatePriceImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
//        0 => "artikul"
//          1 => "naimenovanie"
//          2 => "svobodnyi_ostatok"
//          3 => "zakupocnaia_cena"
//          4 => "optovaia_cena"
//          5 => "brend"
//          6 => "kratkii_artikul"
//          7 => "rrc"
//          8 => "kod"
//          9 => "katalog_tovarov"
//          10 => "gruppa"
//          11 => "ostatokkrasnodar"
//          12 => "rasprodaza"
//          13 => "rrc_onlain"
        foreach ($rows as $row) {
            if (!$row['artikul']) return;
            if (!Product::where('code', $row['artikul'])->exists()) return;

            $product = Product::where('code', $row['artikul'])->first();

            if ($row['cena']) {
                $product->update([
                    'price' => $row['cena'],
                ]);
            }
            if ($row['oblozka']) {
                try {
                    $product->addMediaFromUrl(str_replace(' ', '%20', $row['oblozka']))->toMediaCollection('cover');
                } catch (UnreachableUrl $e) {
                    // Обработка ошибки загрузки обложки
                }
            }
            $photos = collect(explode(';', $row['fotografii']));

            if ($photos->isNotEmpty()) {
                foreach ($photos as $img) {
                    try {
                        $url = str_replace(' ', '%20', $img);
                        $product->addMediaFromUrl($url)->toMediaCollection('photos');
                    } catch (UnreachableUrl $e) {
                        // Обработка ошибки загрузки фотографии
                    }
                }
            }
        }


    }

    public function chunkSize(): int
    {
        return 500;
    }
}
