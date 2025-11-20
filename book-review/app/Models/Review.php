<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['review', 'rating'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    protected static function booted()
    {
        //this will use lazyloading, when the review updated, the change is done to a model, it cannot be done directly in database
        //there are situations where this is not triggered like in database rollback, mass assignment, work directly in database and some others
        static::updated(fn (Review $review) => cache()->forget('book:' . $review->book_id));
        static::deleted(fn (Review $review) => cache()->forget('book:' . $review->book_id));
        static::created(fn (Review $review) => cache()->forget('book:' . $review->book_id));
    }
}
