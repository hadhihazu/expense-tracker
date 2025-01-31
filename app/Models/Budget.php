<?php

namespace App\Models;

use App\Models\User;
use App\Models\Month;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'month_id', 'category_id', 'amount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
