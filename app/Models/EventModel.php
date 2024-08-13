<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    use HasFactory;
    public $table ='event';
    public $primaryKey ='event_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
