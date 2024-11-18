<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public $timestamps = false;

    const ACCESSIBILITY = 1;
    const BEST_PRACTICES = 2;
    const PERFORMANCE = 3;
    const PWA = 4;
    const SEO = 5;
}
