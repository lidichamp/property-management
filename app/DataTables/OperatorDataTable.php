<?php

namespace App\DataTables;

use App\Operator;
use Yajra\DataTables\Services\DataTable;
use DB;
class OperatorDataTable extends DataTable
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
                $menu = '<a href="'.route('operator.manage', $one->id).'" title="Edit" style="margin-right: 10px"><i class="zmdi zmdi-edit"></i></a>';
                $menu .= '<a href="'.route('operator.dashboard', $one->id).'" title="Dashboard" style="margin-right: 10px"><i class="zmdi zmdi-open-in-browser text-success"></i></a>';
                if($one->active==0)
				{
					$menu .= '<a href="'.route('operator.activate_deactivate', $one->id).'" title="Activate" style="margin-right: 10px"><i class="zmdi zmdi-check text-success"></i></a>';
                
				}
				 if($one->active==1)
				{
					$menu .= '<a href="'.route('operator.activate_deactivate', $one->id).'" title="Deactivate" style="margin-right: 10px"><i class="zmdi zmdi-close text-danger"></i></a>';
                
				}
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
     * @param \App\Operator $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Operator $model)
    {
        return $model->newQuery()->select([
            DB::raw('count(trips.id) as trips,operators.id,operators.name,operators.active')
        ])
		->groupBy('operators.id')
		->leftJoin('boats','operators.id','boats.operator')
		->leftJoin('trips','boats.id','trips.boat_id');
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
			'trips'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Operator_' . date('YmdHis');
    }
}
