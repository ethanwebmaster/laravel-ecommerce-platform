<?php

namespace Corals\Foundation\Http\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public $resource_url = '';
    public $title = '';
    public $title_singular = '';
    protected $corals_middleware_except = [];
    protected $corals_middleware = ['auth'];

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->setTheme();
        
        $this->corals_middleware = \Filters::do_filter('corals_middleware', $this->corals_middleware, request());

        $this->middleware($this->corals_middleware, ['except' => $this->corals_middleware_except]);

        $this->middleware(function ($request, $next) {
            $this->setViewSharedData();

            return $next($request);
        });
    }

    public function setTheme()
    {
        \Theme::set(\Settings::get('active_admin_theme', config('themes.corals_admin')));
    }

    /**
     * set variables shared with all controller views
     * @param array $variables
     */
    protected function setViewSharedData($variables = [])
    {
        $this->title_singular = trans(array_get($variables, 'title_singular', $this->title_singular));
        $variables['title_singular'] = $this->title_singular;

        $this->title = trans(array_get($variables, 'title', $this->title));
        $variables['title'] = $this->title;

        $this->resource_url = array_get($variables, 'resource_url', $this->resource_url);
        $variables['resource_url'] = $this->resource_url;

        view()->share($variables);
    }
}