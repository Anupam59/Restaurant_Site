<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemModel extends Model
{
    use HasFactory;
    public $table ='menu_item';
    public $primaryKey ='menu_item_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
