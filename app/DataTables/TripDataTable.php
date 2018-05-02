<?php

namespace App\DataTables;

use App\Trip;
use Yajra\DataTables\Services\DataTable;

class TripDataTable extends DataTable
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
     * @param \App\Trip $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Trip $model)
    {
        return $model->newQuery()->select([
            'trips.id','from.name as departure_jetty','to.name as destination_jetty','boats.name as boat_name','boats.capacity','depature_time'
        ])
		
        ->leftJoin('boats', 'trips.boat_id', 'boats.id')
		->leftJoin('jetties as from', 'trips.from_jetty', 'from.id')
		->leftJoin('jetties as to', 'trips.to_jetty', 'to.id')
        ->where('boats.operator',request()->route('id'));
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
            'boat_name',
			'departure_jetty',
			'destination_jetty',
			'capacity',
			'depature_time'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'trip_' . date('YmdHis');
    }
}
