<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function images() {
        return $this->belongsToMany(Image::class)
                    ->withPivot('path', 'created_at', 'updated_at')
                    ->withTimestamps();
    }
}
