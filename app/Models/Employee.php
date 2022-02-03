<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'cats_number',
        'last_name',
        'first_name',
        'middle_name',
        'address',
        'gender',
        'birthdate',

    ];
}
