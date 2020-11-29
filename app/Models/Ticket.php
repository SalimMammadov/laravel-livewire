<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;


    public function comment()
    {
        return $this->hasMany('App/Comment', 'id', 'support_ticket_id');
    }
}
