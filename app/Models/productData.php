<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productData extends Model
{
    protected $table = 'product_data';
    public $timestamps = true;
    protected $fillable = ['id','name_product','id_supplier'];
    use HasFactory;
}
