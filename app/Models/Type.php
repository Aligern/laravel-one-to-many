<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public static function generateSlug($name) {
        // the slug take the name and turn it into a slug
        $slug = Str::slug($name, '-');
        $count = 1;
        // the slug cycle will run and generate a new one if the slug already exists
        while(Type::where('slug', $slug)->first()) {
            // if the slug already exists, we generate a new one with different count
            $slug = Str::slug($name, '-' . $count);
            $count++;
        }
        return $slug;
    }
}
