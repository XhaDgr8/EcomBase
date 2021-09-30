<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'url',
        'alt',
        'type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(){
        $this->morphedByMany(Product::class, 'mediaable');
    }

    public function variants(){
        $this->morphedByMany(Variant::class, 'mediaable');
    }

    public function categories(){
        $this->morphedByMany(Category::class, 'mediaable');
    }

    public function blogs(){
        $this->morphedByMany(Blog::class, 'mediaable');
    }

    public function metas(){
        $this->morphedByMany(Meta::class, 'mediaable');
    }

    public function reviews(){
        $this->morphedByMany(Review::class, 'mediaable');
    }
}
