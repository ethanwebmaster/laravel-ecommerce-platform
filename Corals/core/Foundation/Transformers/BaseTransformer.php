<?php

namespace Corals\Foundation\Transformers;

use League\Fractal\TransformerAbstract;

class BaseTransformer extends TransformerAbstract
{
    protected $resource_url;
    protected $resource_route;

    public function __construct()
    {
    }

    /**
     * @param $model
     * @param array $actions
     * @param null $url
     * @param bool $merge_actions
     * @return string
     * @throws \Throwable
     */
    protected function actions($model, array $actions = [], $url = null, $merge_actions = true)
    {
        if ($url) {
            $resource_url = $url;
        } else {
            $resource_url = $this->resource_url;
        }
        if ($merge_actions) {

            $actions = array_merge([
                'edit' => [
                    'href' => url($resource_url . '/' . $model->hashed_id . '/edit'),
                    'label' => trans('Corals::labels.edit'),
                    'data' => []
                ],
                'delete' => [
                    'href' => url($resource_url . '/' . $model->hashed_id),
                    'label' => trans('Corals::labels.delete'),
                    'data' => [
                        'action' => 'delete',
                        'table' => '.dataTableBuilder'
                    ]
                ],
            ], $actions);
        }

        $class_name = strtolower(class_basename(get_class($model)));

        $actions = \Filters::do_filter($class_name . '_actions_menu', $actions, $model);

        $actions = array_filter($actions, 'removeEmptyArrayElement');

        if (view()->exists('components.item_actions')) {
            return view('components.item_actions', ['actions' => $actions])->render();
        } else {
            return '';
        }
    }
}