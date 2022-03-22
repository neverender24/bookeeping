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


    public function get_jev_details(Request $request){
        return DB::table('chartofaccounts')->select(DB::raw('TRIM(FACTCODE) as FACTCODE'), 'FTITLE')->get();
    }

    public function getjevDetails(Request $request){
        $details = DB::table('subaccounts1')
                    ->select(
                    'subaccounts1.*',
                    'chartofaccounts.FACTCODE',
                    'chartofaccounts.FTITLE',
                    'subaccounts1.FSUBCDE',
                    'subaccounts1.FSTITLE',
                    DB::raw('TRIM(subaccounts1.FSUBCDE) as FSUBCDE, TRIM(subaccounts1.FSTITLE) as FSTITLE')
                    )
                    ->leftJoin('chartofaccounts', function ($query){
                        $query->on('chartofaccounts.FACTCODE', '=', 'subaccounts1.FACTCODE');
                    })
                    ->where('subaccounts1.FACTCODE','=',$request->FACTCODE)
                    ->get();

                    return $details;
    }

    public function getjevDetailssbcde(Request $request)
    {
        $subcode2 = DB::table('subaccounts2')
                    ->select(
                        'subaccounts2.*',
                        'chartofaccounts.FACTCODE',
                        'chartofaccounts.FTITLE',
                        'subaccounts2.FSUBCDE2',
                        'subaccounts2.FSTITLE2',
                        DB::raw('TRIM(subaccounts2.FSUBCDE2) as FSUBCDE, TRIM(subaccounts2.FSTITLE2) as FSTITLE2')
                    )
                    ->leftJoin('chartofaccounts', function ($query){
                        $query->on('chartofaccounts.FACTCODE', '=', 'subaccounts2.FACTCODE');
                    })
                    ->where('subaccounts2.FACTCODE','=',$request->FACTCODE)
                    ->get();

                    return $subcode2;
    }

    public function get_jevtyp_details()
    {
        return DB::table('funds_details')->select(DB::raw('TRIM(funds_details.FUND_SCODE) as FUND_SCODE'), 'FUNDDETAIL_NAME')->get();
    }

    public function getJevtypdetails()
    {
        return DB::table('jevh')->select(DB::raw('TRIM(jevh.FJEVTYP)'))->get();
    }

}
