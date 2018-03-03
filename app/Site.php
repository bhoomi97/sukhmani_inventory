<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
	protected $fillable = [
       'id', 'site_name'
    ];

    protected $table = 'sites';
}
