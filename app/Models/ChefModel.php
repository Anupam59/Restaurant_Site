<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChefModel extends Model
{
    use HasFactory;
    public $table ='chef';
    public $primaryKey ='chef_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
