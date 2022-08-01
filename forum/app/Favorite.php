<?php

namespace App;
use App\Traits\RecordsActivity;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use RecordsActivity;

    protected $guarded = [];

	//Relations
    public function favorites()
	{
		return $this->morphTo();
	}
}
