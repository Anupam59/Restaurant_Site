<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatterModel extends Model
{
    use HasFactory;
    public $table ='platter';
    public $primaryKey ='platter_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
