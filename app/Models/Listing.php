<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['tag'] ?? false,
            fn($query, $tag) =>
            $query->where('tags', 'like', "%$tag%")
        );

        $query->when(
            $filters['search'] ?? false,
            fn($query, $search) =>
            $query->where(
                fn($query) =>
                $query->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('tags', 'like', "%$search%")
            )
        );
    }


    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}