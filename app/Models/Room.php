<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function reserve()
    {
        return $this->hasMany('App\Models\Reseve');
    }

    protected $fillable = [
        'room_name',
        'color',
        'max_participant',
        'image',
        'admin_permission'
    ];
}
