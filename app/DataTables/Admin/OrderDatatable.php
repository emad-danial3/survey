<?php

namespace App\DataTables\Admin;

use App\Models\Order;
use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class OrderDatatable extends DataTable
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
                return date('D, d M Y g:i A', strtotime($contact->created_at) );
            })

            ->editColumn('status', function ($contact){
                $lang=session()->get('lang');
                if($contact->status == '1')
                    return $lang=='ar' ? 'قيد الانتظار'  :"pending";
                if($contact->status == '2')
                    return $lang=='ar' ? 'تم اختيار المندوب'  :"assigned";
                if($contact->status == '3')
                    return $lang=='ar' ? 'اكتمل'  :"completed";
                if($contact->status == '4')
                    return $lang=='ar' ? 'الغاء'  :"canceled";
                if($contact->status == '5')
                    return $lang=='ar' ? 'تم وصول المندوب'  :"delivered";
                if($contact->status == '6')
                    return $lang=='ar' ? 'اخذ المندوب الطلب'  :"picked up";
                if($contact->status == '7')
                    return $lang=='ar' ? 'بدء الطلب'  :"started";
            })
            ->addColumn('show', 'admin.orders.btn.show')

            ->addColumn('userName', function ($order) {
                    return  $order->user->name;
            })
            ->addColumn('userId', function ($order) {
                return  $order->user_id;
            })
            ->addColumn('user_name', 'admin.orders.btn.user_name')
            ->addColumn('placeName', function ($order) {
                if (session('lang') === 'en') {
                    if( $order->place_id &&$order->place_id >0 &&$order->place_id !=null && $order->place !=null ){
                        return  $order->place->place_langs->where('lang_code', 'en')->first()->name;
                    }

                    else{
                        return '';
                    }
                } else {
                    if( $order->place_id &&$order->place_id >0 &&$order->place_id !=null && $order->place !=null ){
                        return  $order->place->place_langs->where('lang_code', 'ar')->first()->name;
                    }
                    else{
                        return '';
                    }
                }
            })
            ->rawColumns([
                'show',
                'user_name',
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
        return Order::query()->with('user')->with('place')->select('orders.*');
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
                'name' => 'show',
                'data' => 'show',
                'title' => trans('datatable.show'),
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,

            ], [
                'name' => 'id',
                'data' => 'id',
                'title' => 'ID',
            ], [
                'name' => 'user_name',
                'data' => 'user_name',
                'title' => trans('datatable.userName'),
            ],[
                'data' => 'placeName',
                'name' => 'placeName',
                'title' => trans('datatable.placeName'),
            ], [
                'name' => 'delivery_cost',
                'data' => 'delivery_cost',
                'title' => trans('datatable.delivery_cost'),
            ], [
                'name' => 'total_cost',
                'data' => 'total_cost',
                'title' => trans('datatable.total_cost'),
            ]
            , [
                'name' => 'status',
                'data' => 'status',
                'title' => trans('admin.order_status'),
            ],
            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => trans('datatable.created_at'),
            ],
//            , [
//                'name' => 'action',
//                'data' => 'action',
//                'title' => trans('datatable.action'),
//                'exportable' => false,
//                'printable' => false,
//                'orderable' => false,
//                'searchable' => false,
//
//            ],
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

