<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Super_Admin extends Model
{
    use HasFactory;
    protected $primaryKey = 'superadmin_id';
    public $timestamps = false;
}
