<?php

namespace App\Exports\Admin;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductBrandExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Brand::select(['id', 'name', 'slug', 'website', 'seo_title', 'seo_description', 'breadcrumb_name'])->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'Название бренда',
            'Ссылка',
            'Ссылка на сайт',
            'Meta title',
            'Meta description',
            'Хлебная крошка'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 25,
            'D' => 50,
            'E' => 50,
            'F' => 50,
            'G' => 50,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A')->getFont()->setBold(true);
        $sheet->getStyle('A1:Z1')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D9D9D9'],]);
    }
}
