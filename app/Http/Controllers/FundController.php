<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function __construct(Fund $model) {
        $this->model = $model;
    }

    public function getAllFunds() {
        return $this->model->all();
    }
}
