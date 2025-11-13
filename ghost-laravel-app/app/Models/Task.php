<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'long_description'];
    // protected $guarded = ['secret field']; //if you have a field user should not be able to fill, it is opposite of fillable, but it is best not to use it
}
