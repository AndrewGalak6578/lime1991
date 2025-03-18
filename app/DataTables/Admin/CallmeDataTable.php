<?php

namespace App\DataTables\Admin;

use App\Models\Callme;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CallmeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('from_where', function (Callme $callme){
                return view('admin.callmes.fromWhere', [
                    'callme'=>$callme
                ]);
            })
            ->editColumn('actions', function (Callme $callme){
                return view('admin.callmes.actions', [
                    'callme'=>$callme
                ]);
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Callme $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('callme-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('name')->title('Имя'),
            Column::make('phone')->title('Номер телефона'),
            Column::make('from_where')->title('Откуда'),
            Column::make('status')->title('Статус')->searchable('false'),
            Column::make('actions')->title('Действия')->searchable('fasle')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Callme_' . date('YmdHis');
    }
}
