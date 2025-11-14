<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'long_description']; //this is so task title, descriptions and so one can be used just by using Task model without manually writing, $task->title = $data['title'];

    // protected $guarded = ['secret field']; //if you have a field user should not be able to fill, it is opposite of fillable, but it is best not to use it

    public function toggleComplete()
    {
        $this->completed = !$this->completed;
        //yeah this is because the default task is actually false and you need to make '!' before the task completed to make it true regardless
        //and since it just makes it the opposite of what it was it just changes the sate to opposite the current state and therefore works both to make it not complete too
        $this->save();
    }
}
