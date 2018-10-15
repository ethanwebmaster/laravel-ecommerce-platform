<?php

namespace Corals\Modules\CMS\Providers;

use Corals\Modules\CMS\Models\Category;
use Corals\Modules\CMS\Models\Page;
use Corals\Modules\CMS\Models\Post;
use Corals\Modules\CMS\Models\Tag;
use Corals\Modules\CMS\Models\News;
use Corals\Modules\CMS\Policies\CategoryPolicy;
use Corals\Modules\CMS\Policies\PagePolicy;
use Corals\Modules\CMS\Policies\PostPolicy;
use Corals\Modules\CMS\Policies\TagPolicy;
use Corals\Modules\CMS\Policies\NewsPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class CMSAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Page::class => PagePolicy::class,
        Category::class => CategoryPolicy::class,
        Tag::class => TagPolicy::class,
        News::class => NewsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}