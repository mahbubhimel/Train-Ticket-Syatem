<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    public function getTotalPrice()
    {
        return number_format($this->real_price, 2);
    }
}
