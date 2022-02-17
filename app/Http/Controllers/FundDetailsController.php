<?php

namespace App\Http\Controllers;
use App\Models\FundDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FundDetailsController extends Controller
{
    public function __construct(FundDetails $model)
    {
        $this->model = $model;
    }

    public function getFundDetails()
    {
        return $this->model->select(DB::raw('TRIM(FUND_SCODE) as FUND_SCODE'), 'FUNDDETAIL_NAME')->get();
    }
}
