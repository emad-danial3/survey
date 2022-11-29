<?php

namespace App\DataTables\Admin;


use App\Models\Locations;
use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class LocationDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at', function ($contact){
                return date('d/m/Y H:i:s', strtotime($contact->created_at) );
            })->editColumn('status', function ($contact){
                return $contact->status == '1'?"Active":"Not Active";
            })->editColumn('location_type', function ($contact){
                return $contact->location_type == 'general'?"عام":"خاص اساسي";
            })->editColumn('area', function ($contact){
                return $contact->area == 'opera'?"مبني الاوبرا":"خارج مبني الابرا ";
            })->addColumn('action', 'admin.locations.btn.action')
            ->rawColumns([
                'action',
                'nameLocation',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\AdminDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Locations::query()->select('locations.*')->latest();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [[20, 50, 100, 200], [20, 50, 100, trans('datatable.show_all')]],
                'buttons' => [],
                'language' => datatable_lang(),
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => 'id',
                'data' => 'id',
                'title' => 'ID',
            ],[
                'name' => 'name',
                'data' => 'name',
                'title' => trans('datatable.name'),
                'orderable' => false,
            ], [
                'name' => 'status',
                'data' => 'status',
                'title' => trans('datatable.status'),
            ], [
                'name' => 'location_type',
                'data' => 'location_type',
                'title' => trans('Location Type'),
            ], [
                'name' => 'area',
                'data' => 'area',
                'title' => trans('Area'),
            ], [
                'name' => 'action',
                'data' => 'action',
                'title' => trans('datatable.action'),
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,

            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Location_' . date('YmdHis');
    }
}

