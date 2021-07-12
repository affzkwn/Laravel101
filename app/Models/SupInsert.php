<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupInsert extends Model
{
    protected $table = 'supplier_details';
    public $timestamps = true;
    protected $fillable = ['id','name_supplier','contact_supplier'];

}

