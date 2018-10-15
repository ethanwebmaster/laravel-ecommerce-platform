<?php

namespace Corals\Menu\Models;

use Corals\Foundation\Models\BaseModel;
use Corals\Foundation\Traits\Cache\Cachable;
use Corals\Foundation\Transformers\PresentableTrait;
use Corals\Traits\Node\SimpleNode;

class Menu extends BaseModel
{
    use PresentableTrait, SimpleNode, Cachable;

    protected $orderField = 'order';

    protected $fillable = ['parent_id', 'key', 'url', 'active_menu_url',
        'icon', 'roles', 'name', 'description', 'target', 'status', 'order'];

    protected $casts = [
        'roles' => 'array'
    ];
    public $config = 'menu.models.menu';

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->whereStatus('active');
    }

    public function setIconAttribute($value)
    {
        if ($value) {
            $this->attributes['icon'] = 'fa ' . $value;
        } else {
            $this->attributes['icon'] = null;
        }
    }

    public function getUserCanAccessAttribute($value)
    {
        $user_id = '';
        if (user()) {
            $user_id = user()->id;
        } else {
            return true;
        }
        $roles = collect($this->roles);

        if ($roles->isEmpty()) {
            return true;
        }

        if (!user()) {
            return true;
        }

        $userRoles = user()->roles->pluck('id');

        $intersection = $roles->intersect($userRoles);

        return $intersection->count();
    }

    public function getUrlAttribute()
    {
        return $this->attributes['url'] ?? '#';
    }
}