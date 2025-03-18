<?php

namespace App\DataTables\Admin;

use App\Models\ParserItem;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ParserItemsCategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
			return (new EloquentDataTable($query))
				->editColumn('category', function (ParserItem $category){
					if (!empty($category->category)) {
						$_category = ParserItem::find($category->category);
						if ($_category) {
							return $_category->name;
						}
					}
					return $category->category;
				})
				->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ParserItem $model): QueryBuilder
    {
    	return $model->where('type', 'category');
    	// return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('parseritemscategory-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
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
            // Column::make('id'),
            // Column::make('url'),
            Column::make('name'),
            Column::make('category'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ParserItemsCategory_' . date('YmdHis');
    }
}
