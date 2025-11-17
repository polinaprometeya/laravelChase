<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use iLLuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeTitle(Builder $query, string $titleSearch): Builder
    {
        return $query->where('title', 'LIKE', '%' . $titleSearch . '%');
    }

    public function scopePopular(Builder $query): Builder
    {
        //$reviewCount = Book::withCount('review')->get();
        //foreach($reviews as $review){ echo $review->reviews_count;}

        return $query->withCount('reviews')->orderBy('reviews_count', 'desc');
    }

    public function scopeHighestRated(Builder $query): Builder
    {
        return $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
    }



}
