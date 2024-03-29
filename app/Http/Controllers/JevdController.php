<?php

namespace App\Http\Controllers;
use App\Models\Jevd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;
use SebastianBergmann\Environment\Console;

class JevdController extends Controller
{
    public function __construct(Jevd $model)
    {
        $this->model = $model;
    }
    public function index(Request $request)
    {

        $sortField     =  $request->sortBy;
		$length        = $request->length;
        $searchValue   = $request->search;

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
            ->select('jevd.*',
                    'chartofaccounts.FTITLE',
                    'subaccounts1.FTITLE',
                    'subaccounts1.FSTITLE',
                    'subaccounts2.FSTITLE2',
                    'funds_details.FUNDDETAIL_NAME',
                    DB::raw('FORMAT(jevd.FCREDIT, 2) as jevdCredit, FORMAT(jevd.FDEBIT, 2) as jevdDebit')
                )
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
                    ->leftJoin('funds_details', 'jevd.FUND_SCODE', 'funds_details.FUND_SCODE')
                    ->where('jevd.FJEVNO','=',$request->FJEVNO)
                    ->where('jevd.FUND_SCODE','=',$request->FUND_SCODE)
                    ->where('jevd.fiscalyear','=',$request->fiscalyear)
                    ->get();

            return $details;

    }
    public function jevdTotal(Request $request)
    {
        $totalSum = DB::table('jevd')
                    ->select(DB::raw('FORMAT(SUM(jevd.FCREDIT),2) as totalCredit,FORMAT(SUM(jevd.FDEBIT),2) as totalDebit')
                    
                    )
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
                    ->leftJoin('funds_details', 'jevd.FUND_SCODE', 'funds_details.FUND_SCODE')
                    ->where('jevd.FJEVNO','=',$request->FJEVNO)
                    ->where('jevd.FUND_SCODE','=',$request->FUND_SCODE)
                    ->where('jevd.fiscalyear','=',$request->fiscalyear)
                    ->first();

            return $totalSum;
    }

    public function search($collection, $searchValue) {
        if ($searchValue) {
            return $collection->where(function($query) use($searchValue){
                $query->orWhere('fiscalyear','LIKE','%'.$searchValue.'%');
            });
        }
    }

    public function jevdPrintReport(Request $request){
        $details = DB::table('jevd')
                    ->select(
                        'jevd.*',
                        'chartofaccounts.FTITLE',
                        'subaccounts1.FTITLE',
                        'subaccounts1.FSTITLE',
                        'subaccounts2.FSTITLE2',
                        'funds_details.FUNDDETAIL_NAME',
                        'jevh.FJEVTYP',
                        'jevh.FPREPBY',
                        'jevh.FPREPD',
                        'jevh.FAPPVBY',
                        'jevh.FAPPVD',
                        'jevh.FJEVDATE',
                        'jevh.FCHKNO',
                        DB::raw('FORMAT(jevd.FCREDIT, 2) as jevdCredit, FORMAT(jevd.FDEBIT, 2) as jevdDebit'),
                    )
                    ->leftjoin('jevh', function ($query){
                        $query->on('jevh.FUND_SCODE', '=', 'jevd.FUND_SCODE')
                            ->on('jevd.FJEVNO', '=', 'jevh.FJEVNO');
                    })
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
                    ->leftJoin('funds_details', 'jevd.FUND_SCODE', 'funds_details.FUND_SCODE')
                    ->where('jevd.FJEVNO','=',$request->FJEVNO)
                    ->where('jevd.FUND_SCODE','=',$request->FUND_SCODE)
                    ->where('jevd.fiscalyear','=',$request->fiscalyear)
                    ->orderBy('jevd.FACTCODE')
                    ->groupBy('recid')
                    ->get();
        
            return $details;
    }


    public function exportJevtypeReport(Request $request)
    {
        $details = DB::table('jevd')
                    ->select(
                        'jevh.recid',
                        'jevd.FDEBIT',
                        'jevd.FUND_SCODE',
                        'jevd.FCREDIT',
                        'jevd.fiscalyear',
                        'jevd.FJEVNO',
                        'jevd.FACTCODE',
                        'jevh.FJEVTYP',
                        'jevh.FPAYEE',
                        'jevh.FJEVDATE',
                        'funds_details.FUNDDETAIL_NAME',
                        DB::raw('SUM(CASE WHEN jevd.FACTCODE=10101010 THEN jevd.FDEBIT else null END) as debit101'),
                        DB::raw('SUM(CASE WHEN jevd.FACTCODE=40102080 THEN jevd.FCREDIT else null END) as credit080'),
                        DB::raw('SUM(CASE WHEN jevd.FACTCODE=40102040 THEN jevd.FCREDIT else null END) as credit040'),
                        DB::raw('SUM(CASE WHEN jevd.FACTCODE=40102050 THEN jevd.FCREDIT else null END) as credit050'),
                        DB::raw('SUM(CASE WHEN jevd.FACTCODE=40201040 THEN jevd.FCREDIT else null END) as credit1040'),
                        DB::raw('SUM(CASE WHEN jevd.FACTCODE=40202200 THEN jevd.FCREDIT else null END) as credit2200'),
                        DB::raw('SUM(CASE WHEN jevd.FACTCODE=10102010 THEN jevd.FDEBIT else null END) as debit2010'),
                        DB::raw('SUM(CASE WHEN jevd.FACTCODE=10201010 THEN jevd.FDEBIT else null END) as debit201010'),
                        DB::raw('SUM(CASE WHEN jevd.FACTCODE=10101010 THEN jevd.FCREDIT else null END) as credit101010'),

                    )

                    ->leftJoin('jevh', function($query){
                        $query->on('jevh.FUND_SCODE', '=', 'jevd.FUND_SCODE')
                        ->on('jevh.FJEVNO', '=', 'jevd.FJEVNO')
                        ->on('jevh.fiscalyear', '=', 'jevd.fiscalyear');                     
                    })

                    ->leftJoin('funds_details', 'jevd.FUND_SCODE','=', 'funds_details.FUND_SCODE')
                    ->where('jevh.FJEVTYP','=',$request->FJEVTYP)
                    ->where('jevd.FUND_SCODE','=',$request->FUND_SCODE)
                    ->whereBetween('jevh.FJEVDATE',[$request->from,$request->to])
                    ->groupBy('jevd.FJEVNO','jevh.FJEVDATE','jevh.FPAYEE')
                    ->orderBy('FJEVNO')
                    ->get();

            return $details;
    }

    public function jevdtypeSubset(Request $request){
        $subset = DB::table('jevd')
                    ->select(
                        'jevd.FPRNO',
                        'jevd.FDEBIT',
                        'jevd.FUND_SCODE',
                        'jevd.FCREDIT',
                        'jevd.fiscalyear',
                        'jevd.FJEVNO',
                        'jevd.FACTCODE',
                        'jevh.FJEVTYP',
                        'jevh.FPAYEE',
                        'jevh.FJEVDATE',
                    )
                    ->leftJoin('jevh', function($query){
                        $query->on('jevh.FUND_SCODE', '=', 'jevd.FUND_SCODE')
                        ->on('jevh.FJEVNO', '=', 'jevd.FJEVNO')
                        ->on('jevh.fiscalyear', '=', 'jevd.fiscalyear');                     
                    })
                    ->leftJoin('funds_details', 'jevd.FUND_SCODE','=', 'funds_details.FUND_SCODE')
                    ->where('jevd.FACTCODE','!=','40102080')
                    ->where('jevd.FACTCODE','!=','40102040')
                    ->where('jevd.FACTCODE','!=','40202050')
                    ->where('jevd.FACTCODE','!=','40201040')
                    ->where('jevd.FACTCODE','!=','40202200')
                    ->where('jevd.FACTCODE','!=','10101010')
                    ->where('jevd.FACTCODE','!=','10102010')
                    ->where('jevd.FACTCODE','!=','10201010')
                    ->where('jevh.FJEVTYP','=',$request->FJEVTYP)
                    ->where('jevd.FUND_SCODE','=',$request->FUND_SCODE)
                    ->where('jevh.recid','=',$request->recid)
                    ->whereBetween('jevh.FJEVDATE',[$request->from,$request->to])
                    ->orderBy('jevd.FACTCODE')
                    ->get();
                    
        return $subset;           
    }


    // CRUD

    public function store_jdetails(Request $request) 
    {   
        return $this->model->create($request->all());
    }

    public function getAllDetails() 
    {
        return DB::table('chartofaccounts')->select(DB::raw('TRIM(FACTCODE) as FACTCODE'), 'FTITLE')->get();
    }

    public function getJDetails(Request $request)
    {
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

    public function getDetailsSubcode(Request $request)
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
    public function edit_jdetails(Request $request)
    {
        $details = DB::table('jevd')
                    ->select('jevd.*',
                        'chartofaccounts.FACTCODE',
                        'subaccounts1.FSUBCDE',
                        'subaccounts2.FSUBCDE2',
                        'jevd.FVOUCHNO',
                        'jevd.FALOBNO',
                        'jevd.FPRNO',
                        'jevd.FDEBIT',
                        'jevd.FCREDIT',
                        DB::raw('TRIM(jevd.FCREDIT), TRIM(jevd.FDEBIT),TRIM(chartofaccounts.FACTCODE) as FACTCODE, TRIM(subaccounts1.FSUBCDE) as FSUBCDE, TRIM(subaccounts2.FSUBCDE2) as FSUBCDE2')
                        )
                        ->leftjoin('chartofaccounts', function($query) {
                            $query->on('chartofaccounts.FACTCODE', '=', 'jevd.FACTCODE');
                        })
                        ->leftjoin('subaccounts1', function($query) {
                            $query->on('chartofaccounts.FACTCODE', '=', 'subaccounts1.FACTCODE')
                            ->on('subaccounts1.FSUBCDE', '=', 'jevd.FSUBCDE');
                        })
                        ->leftjoin('subaccounts2', function($query) {
                            $query->on('chartofaccounts.FACTCODE', '=', 'subaccounts2.FACTCODE')
                            ->on('subaccounts2.FSUBCDE2', '=', 'jevd.FSUBCDE2');
                        })->where('jevd.recid',$request->id)->first();

                        return $details;    
    }

    public function update_jdetails(Request $request)
    {
        $data = $this->model->where('recid', $request->recid)->first();
        $data->update($request->all());

        return "Success!";
    }

    public function delete_details(Request $request) 
    {
        $data = $this->model->findOrFail($request->id);
        $data->delete();

        return "Deleted!";
    }
}
