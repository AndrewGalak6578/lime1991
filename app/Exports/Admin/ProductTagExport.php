<?php

namespace App\Exports\Admin;

use App\Models\ProductTag;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductTagExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductTag::select(['id', 'name', 'slug', 'product_category_id', 'seo_title', 'seo_description', 'breadcrumb_name'])->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'Название тега',
            'Ссылка',
            'ID категории',
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
