<?php

namespace App\DataTables\Admin;

use App\Models\Atr_policy;
use Yajra\DataTables\Services\DataTable;

class PolicyDatatable extends DataTable
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
            ->addColumn('department', function ($contact){
                return  \App\Models\Department::where('id', $contact->departments_id)->first()->name ;
            })
            ->addColumn('action', 'admin.policies.btn.action')
            ->rawColumns([
                'action',
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
        return Atr_policy::query()->select('atr_policies.*');
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
                'dom'        => 'Blfrtip',
                'lengthMenu' => [[10,25,50,100], [10,25,50, trans('admin.all_record')]],
                'buttons'    =>[],
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
                'name'  => 'id',
                'data'  => 'id',
                'title' => 'ID',
            ],[
                'name'  => 'department',
                'data'  => 'department',
                'title' => trans('admin.departments_id'),
            ],[
                'name'  => 'policy_name',
                'data'  => 'policy_name',
                'title' => trans('admin.policy_name'),
            ],[
                'name'  => 'policy_page',
                'data'  => 'policy_page',
                'title' => trans('admin.policy_page'),
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
        return 'roles_' . date('YmdHis');
    }
}

