<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System_Accounts extends Model
{
    use HasFactory;
    protected $primaryKey = 'username';
    public $timestamps = false;
}
