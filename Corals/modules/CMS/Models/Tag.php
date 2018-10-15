<?php

namespace Corals\Modules\CMS\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Transformers\PresentableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Tag extends BaseModel
{
    use PresentableTrait, LogsActivity;

    /**
     *  Model configuration.
     * @var string
     */
    public $config = 'cms.models.tag';

    protected static $logAttributes = ['name'];

    protected $guarded = ['id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }
}
