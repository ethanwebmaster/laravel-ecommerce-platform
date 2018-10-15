<?php

return [
    'models' => [
        'page' => [
            'presenter' => \Corals\Modules\CMS\Transformers\PagePresenter::class,
            'resource_url' => 'cms/pages',
        ],
        'post' => [
            'presenter' => \Corals\Modules\CMS\Transformers\PostPresenter::class,
            'resource_url' => 'cms/posts',
        ],
        'category' => [
            'presenter' => \Corals\Modules\CMS\Transformers\CategoryPresenter::class,
            'resource_url' => 'cms/categories',
        ],
        'tag' => [
            'presenter' => \Corals\Modules\CMS\Transformers\TagPresenter::class,
            'resource_url' => 'cms/tags',
        ],
        'news' => [
            'presenter' => \Corals\Modules\CMS\Transformers\NewsPresenter::class,
            'resource_url' => 'cms/news',
        ],
    ],
    'frontend' => [
        'page_limit' => 10,
    ]
];