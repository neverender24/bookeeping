<?php

namespace App\Models;

use App\Models\PpmpItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ppmp extends Model
{
    use HasFactory;

    protected $table = "ppmp";
    protected $guarded = [];

    public function ppmp_items() {
        return $this->hasMany(PpmpItem::class, 'id_ppmp');
    }
}
