<?php

namespace App\Http\Controllers;
use App\Models\Jevd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JevdController extends Controller
{
    public function __construct(Jevd $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {

        $sortField     =  $request->sortBy;
		$length         = $request->length;
        $searchValue    = $request->search;

        $index = $this->model->orderBy('recid', 'desc');
    
        if ($sortField) {
            $index = $this->model->orderBy($sortField, 'asc');
        }

        $this->search($index, $searchValue);
        
        $index = $index->paginate($length);

    	return ['data'=>$index, 'draw'=> $request->draw];
    }
    public function jevDetails(Request $request)
    {
        $details = DB::table('jevd')
                    ->select('jevd.*','chartofaccounts.FTITLE','subaccounts1.FTITLE','subaccounts2.FSTITLE2')
                    ->leftJoin('chartofaccounts', function ($query) {
                        $query->on('chartofaccounts.FACTCODE', '=', 'jevd.FACTCODE')
                            ->on('jevd.fiscalyear', '>=', 'chartofaccounts.fiscalyear')
                            ->on('jevd.fiscalyear', '<=', 'chartofaccounts.fiscalyear_to');
                    })
                    ->leftJoin('subaccounts1', function ($query) {
                        $query->on('subaccounts1.FACTCODE', '=', 'jevd.FACTCODE')
                            ->on('subaccounts1.FSUBCDE', '=', 'jevd.FSUBCDE');
                    })
                    ->leftJoin('subaccounts2', function ($query) {
                        $query->on('subaccounts2.FACTCODE', '=', 'jevd.FACTCODE')
                            ->on('subaccounts2.FSUBCDE', '=', 'jevd.FSUBCDE')
                            ->on('subaccounts2.FSUBCDE2', '=', 'jevd.FSUBCDE2');
                    })
                    ->where('jevd.FJEVNO','=',$request->FJEVNO)
                    ->where('jevd.FUND_SCODE','=',$request->FUND_SCODE)
                    ->where('jevd.fiscalyear','=',$request->fiscalyear)
                    ->get();
        
            return $details;
       
    }
    
    

    public function search($collection, $searchValue) {
        if ($searchValue) {
            return $collection->where(function($query) use($searchValue){
                $query->orWhere('fiscalyear','LIKE','%'.$searchValue.'%');
            });
        }
    }
}

