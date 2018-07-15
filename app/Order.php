<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hash',
        'total',
        'paid',
        'address_id',
    ];

    /**
     *  One to Many (inverse) Relationship.
     *  Many orders can have one address
     */
    public function address(){
        return $this->belongsTo('App\Address');
    }

    /**
     *  Many to Many (inverse) Relationship
     */
    public function products(){
        return $this->belongsToMany('App\Product','orders_products')->withPivot('qty');
    }
}
