<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use iLLuminate\Database\Eloquent\Builder;
use illuminate\Database\Query\Builder as QueryBuilder;

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

    public function scopeWithReviewsCount(Builder $query, $from = null, $to = null): Builder | QueryBuilder
    {
        return $query->withCount(['reviews' => fn (Builder $filter) => $this->dateRangeFilter($filter, $from, $to)]);

    }

    public function scopePopular(Builder $query, $from = null, $to = null): Builder | QueryBuilder
    {
        //$reviewCount = Book::withCount('review')->get();
        //foreach($reviews as $review){ echo $review->reviews_count;}

        return $query->WithReviewsCount()
        ->orderBy('reviews_count', 'desc');
    }

    public function scopeWithAvgRating(Builder $query, $from = null, $to = null): Builder | QueryBuilder
    {
        return $query->withAvg(['reviews' => fn (Builder $filter) => $this->dateRangeFilter($filter, $from, $to)], 'rating');
    }

    public function scopeHighestRated(Builder $query, $from = null, $to = null): Builder | QueryBuilder
    {
        return $query->withAvgRating()
        ->orderBy('reviews_avg_rating', 'desc');
    }

    public function scopeMinReviews(Builder $query, int $minReviews): Builder | QueryBuilder
    {
        return $query->having('reviews_count', '>=', $minReviews);
    }

    private function dateRangeFilter(Builder $filter, $from = null, $to = null)
    {

        if ($from && !$to) {
            $filter->where('created_at', '>=', $from);
        } elseif (!$from && $to) {
            $filter->where('created_at', '<=', $to);
        } elseif ($from && $to) {
            $filter->whereBetween('created_at', [$from, $to]);
        }
    }

    public function scopePopularLastMonth(Builder $query): Builder | QueryBuilder
    {
        return $query->popular(now()->subMonth(), now())
        ->highestRated(now()->subMonth(), now())
        ->minReviews(2);
    }

    public function scopePopularLastQuarter(Builder $query): Builder | QueryBuilder
    {
        return $query->popular(now()->subMonth(3), now())
        ->highestRated(now()->subMonth(3), now())
        ->minReviews(4);
    }

    public function scopeHighestRatedLastMonth(Builder $query): Builder | QueryBuilder
    {
        return $query->highestRated(now()->subMonth(), now())
        ->popular(now()->subMonth(), now())
        ->minReviews(2);
    }

    public function scopeHighestRatedLastQuarter(Builder $query): Builder | QueryBuilder
    {
        return $query->highestRated(now()->subMonth(3), now())
        ->popular(now()->subMonth(3), now())
        ->minReviews(4);
    }

    protected static function booted()
    {
        static::updated(fn (Book $book) => cache()->forget('book:' . $book->id));
        static::deleted(fn (Book $book) => cache()->forget('book:' . $book->id));
    }

    //     public function scopeHighestRated(Builder $query): Builder | QueryBuilder
    // {
    //     return $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
    // }
    //     public function scopePopular(Builder $query, $from = null, $to = null): Builder | QueryBuilder
    // {
    //     //$reviewCount = Book::withCount('review')->get();
    //     //foreach($reviews as $review){ echo $review->reviews_count;}

    //     return $query->withCount(['reviews' => function (Builder $filter) use ($from, $to) {
    //         if ($from && !$to) {
    //             $filter->where('created_at', '>=', $from);
    //         } elseif (!$from && $to) {
    //             $filter->where('created_at', '<=', $to);
    //         } elseif ($from && $to) {
    //             $filter->whereBetween('created_at', [$from, $to]);
    //         }
    //     }])->orderBy('reviews_count', 'desc');
    // }

}
