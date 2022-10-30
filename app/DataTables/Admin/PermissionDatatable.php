<?php

namespace App\DataTables\Admin;

use Spatie\Permission\Models\Permission;
use App\Models\Role;
use Yajra\DataTables\Services\DataTable;

class PermissionDatatable extends DataTable
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
            ->addColumn('edit', 'admin.permissions.btn.edit')
            ->addColumn('delete', 'admin.permissions.btn.delete')
            ->rawColumns([
                'edit',
                'delete',
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
        return Role::query()->where('id','>',1);
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
                'lengthMenu' => [[10, 25, 50, 100], [10, 25, 50, trans('admin.all_record')]],
                'buttons' => [
//                    [
//                        'text' => '<i class="fa fa-plus"></i> ' . trans('admin.create_permission'),
//                        'className' => 'btn btn-info', "action" => "function(){
//                                    window.location.href = '" . \URL::current() . "/create';
//                                 }"
//                    ],
                ],
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
                'name' => 'role_en',
                'data' => 'role_en',
                'title' => trans('admin.name'),
            ], [
                'name' => 'role_ar',
                'data' => 'role_ar',
                'title' => trans('admin.name_ar'),
            ], [
                'name' => 'edit',
                'data' => 'edit',
                'title' => trans('admin.edit'),
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,

            ], [
                'name' => 'delete',
                'data' => 'delete',
                'title' => trans('admin.delete'),
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
        return 'permissions_' . date('YmdHis');
    }
}

