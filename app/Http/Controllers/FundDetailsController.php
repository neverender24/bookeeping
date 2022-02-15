<?php

namespace App\Http\Controllers;
use App\Models\FundDetails;
use Illuminate\Http\Request;

class FundDetailsController extends Controller
{
    public function __construct(FundDetails $model)
    {
        $this->model = $model;
    }

    public function getFundDetails()
    {
        return $this->model->select('FUND_SCODE', 'FUNDDETAIL_NAME')->get();
    }
}
