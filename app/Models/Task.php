<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Task extends Model
{
    //
    protected $fillable = [
        'title',
        //'slug',
        'description',
        'completed',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function booted()
    {
        static::creating(function ($task) {
            $baseSlug = Str::slug($task->title);
            $slug = $baseSlug;
            $counter = 1;

            while(static::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $task->slug = $slug;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
