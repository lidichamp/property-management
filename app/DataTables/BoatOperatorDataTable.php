<?php

namespace App\DataTables;

use App\Boat;
use Yajra\DataTables\Services\DataTable;

class BoatOperatorDataTable extends DataTable
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
            ->addColumn('action', function($one){
                $menu = '<a href="/manage_boat/'.request()->route('operator_id').'/'.$one->id.'" title="Edit" style="margin-right: 10px"><i class="zmdi zmdi-edit"></i></a>';
              
                return $menu;
            })
            ->setRowClass(function($one){
                if(request()->route()->parameter('id') == $one->id){
                    return 'text-warning';
                }
                if(!$one->active){
                    return 'text-danger';
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Boat $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Boat $model)
    { ;
        return $model->newQuery()->select([
            'boats.id','boats.name','boats.active', 'boats.make as model','manufacturing_date','registration_id','capacity','jetties.name as home_jetty','operators.name as operator'
        ])
        ->leftJoin('jetties', 'boats.home_jetty', 'jetties.id')
		->leftJoin('operators', 'boats.operator', 'operators.id')
        ->where('operators.id',request()->route('operator_id'));
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
			'home_jetty',
			'operator',
            'model',
            'manufacturing_date',
			'registration_id',
			'capacity'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Boat_' . date('YmdHis');
    }
}
