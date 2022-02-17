<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundDetails extends Model
{
    use HasFactory;
    protected $table = "funds_details";
    protected $guarded = [];
    protected $primaryKey = "recid";

    public function fundDetails()
    {
        return $this->hasMany(InventoryHead::class, 'FUND_SCODE', 'FUND_SCODE');
    }
}
