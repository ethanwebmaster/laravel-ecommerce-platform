<?php

namespace Corals\Modules\Ecommerce\DataTables;

use Corals\Foundation\DataTables\BaseDataTable;
use Corals\Modules\Ecommerce\Models\Wishlist;
use Corals\Modules\Ecommerce\Transformers\WishlistTransformer;
use Yajra\DataTables\EloquentDataTable;

class MyWishlistDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('ecommerce.models.wishlist.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new WishlistTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Wishlist $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Wishlist $model)
    {
        return $model->myWishlist()->newQuery();
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
            'product' => ['title' => trans('Ecommerce::attributes.wishlist.product')],
            'created_at' => ['title' => 'Added at']
        ];
    }

    protected function getOptions()
    {
        return ['has_action' => true];
    }
}
