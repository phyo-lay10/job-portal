<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public function user()
    // {
    //     return $this->hasOne(User::class, 'employer_id');
    // }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'employer_id');
    }

}
