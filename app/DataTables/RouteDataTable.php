<?php

namespace App\DataTables;

use App\Route;
use Yajra\DataTables\Services\DataTable;

class RouteDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)

            ->setRowClass(function($one){
                if(request()->route()->parameter('id') == $one->id){
                    return 'text-warning';
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Route $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Route $model)
    {
        return $model->newQuery()->select([
            'routes.id','from.name as departure_jetty','to.name as destination_jetty','routes.name as name','routes.km_estimate as distance','routes.ref as refrence_number'
        ])
		->leftJoin('jetties as from', 'routes.from_jetty', 'from.id')
		->leftJoin('jetties as to', 'routes.to_jetty', 'to.id');
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
                    ->removeColumn('id')
                    ->minifiedAjax()
                    ->addAction(['width' => '10px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'name',
			'departure_jetty',
			'destination_jetty',
			'distance',
			'refrence_number'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'route_' . date('YmdHis');
    }
}
