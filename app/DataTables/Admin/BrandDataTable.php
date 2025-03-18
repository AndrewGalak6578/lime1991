<?php

namespace App\DataTables\Admin;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('products', function (Brand $brand){
                return '0';
            })
            ->editColumn('collections', function (Brand $brand){
                return $brand->collections()->count();
            })
            ->editColumn('photo', function (Brand $brand){
                return view('admin.products.brands.logo', [
                    'logo'=>$brand->logo
                ]);
            })
            ->editColumn('actions', function(Brand $brand){
                return view('admin.products.brands.actions', [
                    'brand'=>$brand
                ]);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('brand-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
            Column::make('name')->title('Название'),
            Column::make('collections')->title('Кол.коллекций')->searchable(false),
            Column::make('photo')->title('фото')->searchable(false),
            Column::make('products')->title('Кол.товаров')->searchable(false),
            Column::make('actions')->title('Действия')->searchable(false)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Brand_' . date('YmdHis');
    }
}
