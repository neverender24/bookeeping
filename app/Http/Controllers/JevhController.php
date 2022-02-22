<?php

namespace App\Http\Controllers;

use App\Models\Jevh;
use App\Exports\JevhExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class JevhController extends Controller
{
    public function __construct(Jevh $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
		$length         = $request->length;
        $searchValue    = $request->search;

        $index = $this->getClause($request);

        $index = $index->orderBy('FJEVNO', 'asc');
        
        $this->search($index, $searchValue);
        
        $index = $index->paginate($length);

    	return ['data'=>$index, 'draw'=> $request->draw];
    }

    
    public function search($collection, $searchValue) {
        if ($searchValue) {
            return $collection->where(function($query) use($searchValue){
                $query->orWhere('fiscalyear','LIKE','%'.$searchValue.'%');
            });
        }
    }
    
    public function getJevtype()
    {
        return $this->model->select(DB::raw('TRIM(FJEVTYP) as FJEVTYP'))->get();
    }

    public function export(Request $request)
    {
        $searchValue    = $request->search;

        $index = $this->getClause($request);

        $index = $index->orderBy('FJEVNO', 'asc');

        $this->search($index, $searchValue);

        $index = $index->get();

        return ['data'=>$index, 'draw'=> $request->draw];
    }
    
    public function getClause($request)
    {
        $index = $this->model;

        if ($request->FUND_SCODE) {
            $index = $index->where('FUND_SCODE', $request->FUND_SCODE);
        }

        if ($request->FJEVNO) {
            $index = $index->where('FJEVNO', 'like' , '%'.$request->FJEVNO.'%');
        }

        if ($request->FCHKNO) {
            $index = $index->where('FCHKNO', 'like' , '%'.$request->FCHKNO.'%');
        }

        if ($request->FREFNO) {
            $index = $index->where('FREFNO', 'like' , '%'.$request->FREFNO.'%');
        }

        if ($request->FJEVTYP) {
            $index = $index->where('FJEVTYP', 'like' , '%'.$request->FJEVTYP.'%');
        }

        if ($request->FPAYEE) {
            $index = $index->where('FPAYEE', 'like' , '%'.$request->FPAYEE.'%');
        }
        
        if (($request->from && !$request->to) || ($request->to && !$request->from)) {
            
            $date = $request->from ? $request->from : $request->to;

            $index = $index->whereDate('FJEVDATE', $date);
        } 
        if($request->from && $request->to) {
            $index = $index->whereBetween('FJEVDATE', [$request->from, $request->to]);
        }
        if ($request->sortBy) {
            $index = $this->model->orderBy($request->sortBy, 'asc');
        }
        
        return $index;
    }
    
}
