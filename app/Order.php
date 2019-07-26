<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUS_CREATED = 1;
    public const STATUS_ACCEPTED = 2;
    public const STATUS_REJECT = 3;

    protected $guarded = [];
    public function service(){
        return $this->belongsTo('App\Service');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function statusName(){
        return [
            1 => 'Created',
            2 => 'Accepted',
            3 => 'Rejected'
        ][$this->status];
    }
}
