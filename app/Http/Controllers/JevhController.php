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
                $query->orWhere('FJEVNO','LIKE','%'.$searchValue.'%');
                $query->orWhere('FUND_SCODE','LIKE','%'.$searchValue.'%');
                $query->orWhere('FCHKNO','LIKE','%'.$searchValue.'%');
                $query->orWhere('FPAYEE','LIKE','%'.$searchValue.'%');
                $query->orWhere('FREMK','LIKE','%'.$searchValue.'%');
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
    public function store_jevh(Request $request) 
    {   
        return $this->model->create($request->all());
    }

    public function get_jevtyp_details()
    {
        return DB::table('funds_details')->select(DB::raw('TRIM(funds_details.FUND_SCODE) as FUND_SCODE'), 'FUNDDETAIL_NAME')->get();
    }

    public function getJevtypdetails()
    {
        return DB::table('jevh')->select(DB::raw('TRIM(jevh.FJEVTYP)'))->get();
    }

    public function edit_jevh_details(Request $request)
    {
        $jevhdetails = DB::table('jevh')
                    ->select('jevh.*',
                            'funds_details.FUND_SCODE',
                            'jevh.FJEVNO',
                            'jevh.FJEVTYP',
                            'jevh.FJEVNO',
                            'jevh.FCHKNO',
                            'jevh.FREMK',
                            'jevh.FPREPBY',
                            'jevh.FPREPD',
                            'jevh.FAPPVBY',
                            DB::raw('TRIM(jevh.FUND_SCODE), TRIM(jevh.FJEVTYP), TRIM(jevh.FREMK)')
                            )
                            ->leftjoin('funds_details', function($query) {
                                $query->on('jevh.FUND_SCODE', '=', 'funds_details.FUND_SCODE');
                            })
                            ->where('jevh.recid', $request->id)->first();

                            return $jevhdetails;
    }

    public function update_jevh_details(Request $request)
    {
        $data = $this->model->where('recid', $request->recid)->first();
        $data->update($request->all());

        return "Success!";
    }

    public function delete_jevh_entry(Request $request)
    {
        $data = $this->model->findOrFail($request->id);
        $data->delete();

        return "Deleted!";
    }

}
