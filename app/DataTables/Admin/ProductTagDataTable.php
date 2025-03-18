<?php

namespace App\DataTables\Admin;

use App\Models\ProductTag;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductTagDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('products', function (ProductTag $productTag){
                return '0';
            })
            ->editColumn('category', function (ProductTag $productTag){
                return ($productTag->product_category_id == 0) ? 'Общий тег' : $productTag->category->name;
            })
            ->editColumn('actions', function (ProductTag $productTag){
                return view('admin.products.tags.actions', [
                    'productTag'=>$productTag
                ]);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductTag $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('producttag-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
//                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
//            Column::computed('action')
//                  ->exportable(false)
//                  ->printable(false)
//                  ->width(60)
//                  ->addClass('text-center'),
//            Column::make('id'),
            Column::make('name')->title('Название'),
            Column::make('products')->title('Кол. товаров')->searchable(false),
            Column::make('category')->title('Категория')->searchable(false),
            Column::make('actions')->title('Действия')->searchable(false),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductTag_' . date('YmdHis');
    }
}
