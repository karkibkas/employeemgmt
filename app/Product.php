<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function hasLowStock(){
        if($this->outOfStock()){
            return false;
        }
        return $this->quantity <= 5;
    }

    public function outOfStock(){
        return $this->quantity === 0;
    }

    public function inStock(){
        return $this->quantity >= 1;
    }

    public function hasStock($qty){
        return $this->quantity >= $qty;
    }
}
