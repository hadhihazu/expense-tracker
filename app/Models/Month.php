<?php

namespace App\Models;

use App\Models\Budget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Month extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }
}
