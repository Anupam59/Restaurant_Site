<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonPageModel extends Model
{
    use HasFactory;
    public $table ='common_page';
    public $primaryKey ='page_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
