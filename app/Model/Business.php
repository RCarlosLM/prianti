<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;

    protected $table = 'businesses';
	protected $fillable = [
		'business_name',
		'address',
        'file',
        'short_name'
	];

}
