<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'sideImage1',
        'sideImage2',
        'arthur',
        'main_category_name',
        'category_name',
        'reading_guide',
        'price',
        'description',
        'pages',
        'size',
        'print_record',
        'in_stock',
        'editor_choice',
        'classic',
        'reward',
        'view_count'
    ];
}
