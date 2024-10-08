<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialModel extends Model
{
    use HasFactory;
    public $table ='testimonial';
    public $primaryKey ='testimonial_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
