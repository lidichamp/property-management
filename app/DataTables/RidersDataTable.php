<?php

namespace App\DataTables;

use App\Passenger;
use Yajra\DataTables\Services\DataTable;

class RidersDataTable extends DataTable
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
     * @param \App\Passenger $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Passenger $model)
    {
        return $model->newQuery()->select([
            'passengers.id','passengers.name','passengers.kin as next_of_kin','passengers.kin_phone as next_of_kin_contact'
        ]);
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
			'next_of_kin',
			'next_of_kin_contact'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'riders_' . date('YmdHis');
    }
}
