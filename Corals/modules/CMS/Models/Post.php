<?php

namespace Corals\Modules\CMS\Models;

use Illuminate\Database\Eloquent\Builder;

class Post extends Content
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'post');
        });
    }

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'cms.models.post';

    protected $attributes = [
        'type' => 'post'
    ];

    protected $fillable = ['id', 'title', 'slug', 'meta_keywords',
        'meta_description', 'content', 'published', 'published_at', 'private', 'internal', 'type', 'author_id', 'featured_image_link'];


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function activeTags()
    {
        return $this->belongsToMany(Tag::class)->where('status', 'active');
    }
}
