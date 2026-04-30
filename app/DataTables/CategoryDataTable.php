<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

// ... imports stay the same

class CategoryDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('image', function($row) {
                return $row->image ? '<img src="'.asset('storage/'.$row->image).'" class="w-12 h-12 object-cover rounded">' : 'N/A';
            })
            ->editColumn('is_active', function($row) {
                return $row->is_active ? '✅' : '❌';
            })
            ->addColumn('action', 'categories.action')
            ->rawColumns(['action', 'image', 'is_active'])
            ->setRowId('id');
    }

    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('category-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1) // Orders by 'id'
                    ->selectStyleSingle()
                    ->parameters([
                        'dom' => 'Bfrtip', // Enables Buttons, Search, and Pagination
                    ])
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('image')->title('Photo'),
            Column::make('name'),
            Column::make('name_kh')->title('Name (KH)'),
            Column::make('is_active')->title('Status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
                  ->addClass('text-center'),
        ];
    }
}