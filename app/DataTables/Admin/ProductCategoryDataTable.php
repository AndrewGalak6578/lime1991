<?php

namespace App\DataTables\Admin;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('subCategories', function (ProductCategory $productCategory){
                return $productCategory->subProductCategories()->count();
            })
            ->editColumn('actions', function(ProductCategory $productCategory){
                return view('admin.products.categories.actions', [
                    'productCategory'=>$productCategory
                ]);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductCategory $model): QueryBuilder
    {
//        return $model->where('parent_id',  0)->newQuery();
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('productcategory-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
//                    ->orderBy(0)
//                    ->selectStyleSingle()
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
            Column::make('subCategories')->title('Кол.подкатегорий')->searchable(false),
            Column::make('actions')->title('Действия')->searchable(false)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductCategory_' . date('YmdHis');
    }
}
