<?php

namespace Corals\Foundation\DataTables;


use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;

class CoralsBuilder extends Builder
{
    public $filters;
    public $options;
    public $resource_url;

    public function setFilters($filters = [])
    {
        $this->filters = $filters;
        return $this;
    }

    public function setOptions($options = [])
    {
        $this->options = $options;
        return $this;
    }

    public function setTableId($id)
    {
        return parent::setTableId($id);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function filters()
    {
        $filtersFields = $this->filters;

        $tableId = $this->getTableAttribute('id');

        $filters = '<div class="filters" data-table="' . $tableId . '" id="' . $tableId . '_filters">';

        $rowColumns = 0;

        foreach ($filtersFields as $key => $field) {
            if (!$field['active']) {
                continue;
            }

            $classArray = explode('-', $field['class']);

            $colNumber = $classArray[count($classArray) - 1];

            if ($rowColumns == 0) {
                $filters .= '<div class="row" >';
            }

            if ($rowColumns > 0 && ($rowColumns + $colNumber) > 12) {
                $rowColumns = 0;
                //row closing
                $filters .= '</div>';
                //start new row
                $filters .= '<div class="row" >';
            }

            $filters .= '<div class="' . $field['class'] . '">';

            $attributes = ['class' => 'filter', 'placeholder' => $field['placeholder'] ?? $field['title']];

            switch ($field['type']) {
                case 'text':
                    $filters .= \CoralsForm::text($key, null, false, null, $attributes);
                    break;
                case 'number':
                    $filters .= \CoralsForm::number($key, null, false, null, $attributes);
                    break;
                case 'date':
                    $filters .= \CoralsForm::date($key, null, false, null, $attributes);
                    break;
                case 'date_range':
                    $filters .= \CoralsForm::dateRange($key, '', false, null, $attributes);
                    break;
                case 'select':
                    $filters .= \CoralsForm::select($key, null, $field['options'], false, null, ['placeholder' => $placeholder = trans('Corals::labels.select', ['label' => $field['title']]), 'class' => 'filter']);
                    break;
                case 'select2':
                    $filters .= \CoralsForm::select($key, null, $field['options'], false, null, ['data-placeholder' => trans('Corals::labels.select', ['label' => $field['title']]), 'class' => 'filter'], 'select2');
                    break;
                case 'boolean':
                    $filters .= \CoralsForm::checkbox($key, $field['title'], false, $field['checked_value'] ?? 1, ['class' => 'filter']);
                    break;
            }

            //col closing
            $filters .= '</div>';

            if (is_numeric($colNumber)) {
                if (($rowColumns + $colNumber) >= 12) {
                    $rowColumns = 0;
                    //row closing
                    $filters .= '</div>';
                } else {
                    $rowColumns += $colNumber;
                }
            }
        }

        if ($rowColumns + 1 > 12) {
            //row closing
            $filters .= '</div>';
            $rowColumns = 0;
        }
        if ($rowColumns == 0) {
            $filters .= '<div class="row" >';
        }
        if (!empty($filtersFields)) {
            $filters .= '<div class="col-md-1 p-r-0">' .
                \CoralsForm::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-primary filterBtn', 'data-table' => $tableId]) . '&nbsp;&nbsp;' .
                \CoralsForm::button('<i class="fa fa-eraser"></i>', ['class' => 'btn btn-default clearBtn', 'data-table' => $tableId]);

            $filters .= '</div></div></div>';
        } else {
            $filters = '';
        }

        return $filters;
    }

    /**
     * Add a action column.
     *
     * @param  array $attributes
     * @return $this
     */
    public function addAction(array $attributes = [])
    {
        $options = $this->options;

        if (isset($options['has_action']) && !$options['has_action']) {
            return $this;
        }

        $attributes = array_merge([
            'defaultContent' => '',
            'data' => 'action',
            'name' => 'action',
            'title' => trans('Corals::labels.action'),
            'render' => null,
            'orderable' => false,
            'searchable' => false,
            'exportable' => false,
            'printable' => true,
            'footer' => '',
        ], $attributes);
        $this->collection->push(new Column($attributes));

        return $this;
    }

    public function assets()
    {
        $options = $this->options;

        static::DataTableScripts();
        if (isset($options['ordering']) && $options['ordering']) {
            \Assets::add(asset('assets/corals/plugins/datatables-reorder/dataTables.rowReorder.min.js'));
            \Assets::add(asset('assets/corals/plugins/datatables-reorder/rowReorder.dataTables.min.css'));
        }

    }

    public static function DataTableScripts()
    {
        \Assets::add(asset('assets/corals/plugins/datatables.net-bs/css/dataTables.bootstrap4.min.css'));
        \Assets::add(asset('assets/corals/plugins/datatables.net/js/jquery.dataTables.min.js'));
        \Assets::add(asset('assets/corals/plugins/datatables.net-bs/js/dataTables.bootstrap4.min.js'));
        \Assets::add(asset('assets/corals/plugins/datatables-buttons/js/dataTables.buttons.min.js'));
        \Assets::add(asset('assets/corals/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'));
        \Assets::add(asset('assets/corals/plugins/datatables-buttons/css/buttons.bootstrap4.min.css'));
        \Assets::add(asset('assets/corals/plugins/datatables.net/js/buttons.server-side.js'));

    }

    /**
     * @param null $script
     * @param array $attributes
     * @return \Illuminate\Support\HtmlString
     * @throws \Exception
     */
    public function scripts($script = null, array $attributes = ['type' => 'text/javascript'])
    {
        $tableId = $this->getTableAttribute('id');

        $script = $script ?: $this->generateScripts();

        $options = $this->options;

        $script .= "
            $(document).on('change', '#{$tableId} .datatable-check-all', function(event){
                if($(this).prop('checked')){
                    $('#{$tableId} .datatable-row-checkbox').prop('checked',true).iCheck('update');
                }else{
                    $('#{$tableId} .datatable-row-checkbox').prop('checked',false).iCheck('update');
                }
            });
            
            $(document).on('change', '#{$tableId} .datatable-row-checkbox', function(event){
                var checkboxes = $('#{$tableId} .datatable-row-checkbox');
                
                if (checkboxes.length == checkboxes.filter(':checked').length) {
                    $('#{$tableId} .datatable-check-all').prop('checked', 'checked').iCheck('update');
                } else {
                    $('#{$tableId} .datatable-check-all').prop('checked', false).iCheck('update');
                }
            });
            ";

        if (isset($options['ordering']) && $options['ordering']) {
            $script .= "
            var table = $('#{$tableId}').DataTable();
            
            table.on('row-reorder', function (e, diff, edit) {
                var orderArray = [];
                for (var i = 0, ien = diff.length; i < ien; i++) {
                    var rowData = table.row(diff[i].node).data();
                    orderArray.push({
                        id: rowData.id,			// record id from datatable
                        position: diff[i].newPosition		// new position
                    });
                }
                var jsonString = JSON.stringify(orderArray);
                $.ajax({
                    url: '" . $options['resource_url'] . "/reorder',
                    type: 'POST',
                    data: jsonString,
                    dataType: 'json',
                    success: function (json) {
                    $('#{$tableId}').DataTable().ajax.reload(); // now refresh datatable
                    $.each(json, function (key, msg) {
                        themeNotify(msg);
                    });
                }
                });
            });";
        }

        return parent::scripts($script, $attributes);
    }

    /**
     * Add a checkbox column.
     *
     * @param  array $attributes
     * @param  bool|int $position true to prepend, false to append or a zero-based index for positioning
     * @return $this
     */
    public function addCheckbox(array $attributes = [], $position = false)
    {
        $dataTableId = array_pull($attributes, 'datatable_id');

        $attributes = array_merge([
            'defaultContent' => '<input type="checkbox" class="datatable-row-checkbox" />',
            'title' => '<input type="checkbox" class="datatable-check-all" id="' . $dataTableId . '_dataTablesCheckbox' . '"/>',
            'data' => 'checkbox',
            'name' => 'checkbox',
            'orderable' => false,
            'searchable' => false,
            'exportable' => false,
            'printable' => true,
            'width' => '10px',
        ], $attributes);
        $column = new Column($attributes);

        if ($position === true) {
            $this->collection->prepend($column);
        } elseif ($position === false || $position >= $this->collection->count()) {
            $this->collection->push($column);
        } else {
            $this->collection->splice($position, 0, [$column]);
        }

        return $this;
    }
}