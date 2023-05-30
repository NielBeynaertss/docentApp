<?php

namespace App\Models;
use App\Models\Category;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'description',
        'remarks',
        'phone',
        'website',
        'approved',
        'location_id',
        'category_id',
        'streetnr',
        'codecity',
    ];
    
}
