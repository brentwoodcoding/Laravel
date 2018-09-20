<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientcase extends Model
{
	protected $primaryKey = 'Case #';
	public $timestamps = false;
	public $incrementing = false;
}
