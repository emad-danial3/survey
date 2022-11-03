<?php

namespace App\DataTables\Admin;

use App\User;

use App\Models\UsersSurveys;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class UserSurveysDatatable extends DataTable
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
            })
            ->addColumn('survey', function ($contact){
                return  \App\Models\Page::where('id', $contact->survey_id)->first()->name ;
            })
            ->addColumn('location', function ($contact){
                return  \App\Models\Locations::where('id', $contact->location_id)->first()->name ;
            })
            ->addColumn('action', 'admin.reports.btn.action')

            ->rawColumns([
                'action',
                'location',
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
        return UsersSurveys::query()->select('users_surveys.*')->latest();
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
                'buttons'    =>[
                    ['extend'   => 'print', 'className' => 'btn btn-primary',
                        'text' => '<i class="fa fa-print"></i>'],
                    ['extend'   => 'excel', 'className' => 'btn btn-success',
                        'text' => '<i class="fa fa-file"></i> '. 'excel'],
                    ['extend'   => 'reload', 'className' => 'btn btn-default',
                        'text' => '<i class="fa fa-refresh"></i> '],
                ],

                'initComplete' => " function () {
                            this.api().columns([0,1,2,3]).every(function() {
                                    var column = this;
                                    var input = document.createElement(\"input\");
                                    $(input).appendTo($(column.footer()).empty())
                                    .on('keyup', function() {
                                            column.search($(this).val(), false, false, true).draw();
                                        });
                                    });
                            }",
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
            ], [
                'name' => 'name',
                'data' => 'LAST_NAME',
                'title' => trans('datatable.name'),
            ],[
                'name' => 'email',
                'data' => 'EMAIL_ADDRESS',
                'title' => trans('datatable.email'),
            ],[
                'name' => 'survey',
                'data' => 'survey',
                'title' => trans('datatable.survey'),
            ],[
                'name' => 'location',
                'data' => 'location',
                'title' => trans('datatable.location'),
            ], [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => trans('datatable.created_at'),
            ], [
                'name' => 'action',
                'data' => 'action',
                'title' => trans('datatable.action'),
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,

            ]
//            , [
//                'name' => 'posts',
//                'data' => 'posts',
//                'title' => trans('admin.Posts'),
//                'exportable' => false,
//                'printable' => false,
//                'orderable' => false,
//                'searchable' => false,
//
//            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}

