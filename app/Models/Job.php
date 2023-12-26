<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // protected $guarded = [];
    protected $fillable = ['category_id', 'employer_id', 'title', 'description', 'salary'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function employer()
    {
        return $this->belongsTo(User::class);
    }
}
