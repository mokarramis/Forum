<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Channel extends Model
{
    public function threads(){
        return $this->HasMany(Thread::class, 'channel_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
