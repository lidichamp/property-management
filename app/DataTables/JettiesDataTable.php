<?php

namespace App\DataTables;

use App\Jetty;
use Yajra\DataTables\Services\DataTable;

class JettiesDataTable extends DataTable
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
                $menu = '<a href="'.route('jetty.manage', $one->id).'" title="Edit" style="margin-right: 10px"><i class="zmdi zmdi-edit"></i></a>';
				if($one->latitude) {
                    
				$menu .= '<a href="https://www.google.com/maps/search/?api=1&query='.$one->latitude.','.$one->longitude.'" target="_blank" title="View in map"><i class="zmdi zmdi-eye text-success"></i></a>';
				}
                return $menu;
				
            })
            ->setRowClass(function($one){
                if(request()->route()->parameter('id') == $one->id){
                    return 'text-warning';
                }
                
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Jetty $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Jetty $model)
    {
        return $model->newQuery()->select([
            'jetties.id','jetties.name','operators.name as operator','jetties.address','jetties.latitude','jetties.longitude'
        ])
		 ->leftJoin('operators', 'jetties.operator', 'operators.id');
           
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
			'operator',
            'address'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Jetties_' . date('YmdHis');
    }
}
