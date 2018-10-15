<?php

namespace Corals\User\DataTables;

use Corals\Foundation\DataTables\BaseDataTable;
use Corals\User\Facades\Roles;
use Corals\User\Models\User;
use Corals\User\Transformers\UserTransformer;
use Yajra\DataTables\EloquentDataTable;

class UsersDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('user.models.user.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new UserTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(User $model)
    {
        $model = $model->with('roles')->select('users.*');

        return $model;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['visible' => false],
            'picture_thumb' => ['width' => '35px', 'title' => trans('User::attributes.user.picture_thumb'), 'orderable' => false, 'searchable' => false],
            'name' => ['title' => trans('User::attributes.user.name')],
            'email' => ['title' => trans('User::attributes.user.email')],
            'roles' => ['name' => 'roles.name', 'title' => trans('User::attributes.user.roles'), 'orderable' => false],
            'created_at' => ['title' => trans('Corals::attributes.created_at')],
            'updated_at' => ['title' => trans('Corals::attributes.updated_at')],
        ];
    }

    protected function getFilters()
    {
        return [
            'name' => ['title' => trans('User::attributes.user.name'), 'class' => 'col-md-3', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'roles.id' => ['title' => trans('User::attributes.user.roles'), 'class' => 'col-md-2', 'type' => 'select', 'options' => Roles::getRolesList(), 'active' => true],
            'created_at' => ['title' => trans('Corals::attributes.created_at'), 'class' => 'col-md-2', 'type' => 'date', 'active' => true],
        ];
    }
}
