<?php

namespace App\Exports\Admin;

use App\Models\BrandCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductBrandCollectionExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BrandCollection::select(['id', 'name', 'slug', 'brand_id', 'seo_title', 'seo_description', 'breadcrumb_name'])->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'Название коллекции',
            'Ссылка',
            'ID бренда',
            'Название бренда (не обновляется)',
            'Meta title',
            'Meta description',
            'Хлебная крошка'
        ];
    }

    public function map($brandCollection): array
    {
        return [
            $brandCollection->id,
            $brandCollection->name,
            $brandCollection->slug,
            $brandCollection->brand_id,
            $brandCollection->brand->name,
            $brandCollection->seo_title,
            $brandCollection->seo_description,
            $brandCollection->breadcrumb_name,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 25,
            'D' => 5,
            'E' => 30,
            'F' => 50,
            'G' => 50,
            'H' => 50,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A')->getFont()->setBold(true);
        $sheet->getStyle('A1:Z1')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D9D9D9'],]);
    }
}
