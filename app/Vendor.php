<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
       'id', 'vendor'
    ];

    protected $table = 'vendors';
}
