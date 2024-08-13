<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteCommonModel extends Model
{
    use HasFactory;
    public $table ='site_common';
    public $primaryKey ='site_common_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
