<?php


namespace PowerComponents\LivewirePowerGrid;

class Column
{

    public string $title = '';
    public bool $searchable = true;
    public bool $sortable = false;
    public bool $html = false;
    public string $field = '';
    public string $header_class = '';
    public string $header_style = '';
    public string $body_class = '';
    public string $body_style = '';
    public bool $hidden = false;
    public bool $visible_in_export = false;
    public array $filter_date_between = [];
    public array $inputs = [];
    public bool $editable = false;
    public array $toggleable = [];
    public array $click_to_copy = [];

    /**
     * @return static
     */
    public static function add()
    {
        return new static();
    }

    /**
     * Column title representing a field
     *
     * @param string $title
     * @return $this
     */
    public function title( string $title ): Column
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Will enable the column for search
     *
     * @return $this
     */
    public function searchable(): Column
    {
        $this->searchable = true;
        return $this;
    }

    /**
     * Will enable the column for sort
     *
     * @return $this
     */
    public function sortable(): Column
    {
        $this->sortable = true;
        $this->html = false;
        return $this;
    }

    /**
     * Field name in the database
     *
     * @param string $field
     * @return $this
     */
    public function field( string $field ): Column
    {
        $this->field = $field;
        return $this;
    }

    /**
     * Class html tag header table
     *
     * @param string $class_attr
     * @param string $style_attr
     * @return $this
     */
    public function headerAttribute( string $class_attr = '', string $style_attr = '' ): Column
    {
        $this->header_class = $class_attr;
        $this->header_style = $style_attr;
        return $this;
    }

    /**
     * Class html tag body table
     *
     * @param string $class_attr
     * @param string $style_attr
     * @return $this
     */
    public function bodyAttribute( string $class_attr = '', string $style_attr = '' ): Column
    {
        $this->body_class = $class_attr;
        $this->body_style = $style_attr;
        return $this;
    }

    /**
     * When the field has any changes within the scope using Collection
     *
     * @return $this
     */
    public function html(): Column
    {
        $this->html = true;
        $this->sortable = false;
        return $this;
    }

    public function hidden(): Column
    {
        $this->hidden = true;
        return $this;
    }

    public function visibleInExport( bool $visible ): Column
    {
        $this->visible_in_export = $visible;
        $this->searchable = false;
        return $this;
    }

    /**
     * Add the @datatableFilter directive before the body
     *
     * @param string $class_attr
     * @param array $config [
     * 'only_future' => true,
     * 'no_weekends' => true
     * ]
     * @return $this
     */
    public function filterDateBetween( string $class_attr = '', array $config = [] ): Column
    {
        $this->filter_date_between = [
            'enabled' => true,
            'config' => $config,
            'class' => (blank($class_attr)) ? 'col-3' : $class_attr
        ];
        return $this;
    }


    /**
     * @param $data_source
     * @param string $display_field
     * @param string $relation_id
     * @param array $settings
     * @return $this
     */
    public function makeInputSelect( $data_source, string $display_field, string $relation_id, array $settings = [] ): Column
    {
        $this->editable = false;
        $this->inputs['select']['data_source'] = $data_source;
        $this->inputs['select']['display_field'] = $display_field;
        $this->inputs['select']['relation_id'] = $relation_id;
        $this->inputs['select']['class'] = $settings['class'] ?? '';
        $this->inputs['select']['live-search'] = $settings['live-search'] ?? true;

        return $this;
    }

    /**
     * @param string $from_column
     * @param array $settings
     * @param string $class_attr
     * @return Column
     */
    public function makeInputDatePicker( string $from_column, array $settings = [], string $class_attr = '' ): Column
    {
        // $this->editable = false;
        $this->inputs['date_picker']['enabled'] = true;
        $this->inputs['date_picker']['class'] = $class_attr;
        $this->inputs['date_picker']['config'] = $settings;
        $this->inputs['date_picker']['from_column'] = $from_column;
        return $this;
    }

    /**
     * Adds Edit on click to a column
     *
     * @param bool $hasPermission
     * @return Column
     */
    public function editOnClick( bool $hasPermission = true ): Column
    {
        $this->editable = $hasPermission;
        return $this;
    }


    /**
     * Adds Toggle to a column
     *
     * @param bool $hasPermission
     * @return Column
     */
    public function toggleable( bool $hasPermission = true, array $default = [] ): Column
    {
        $this->toggleable = [
            'enabled' => $hasPermission,
            'default' => count($default) ? $default : [__('active'), __('not active')]
        ];
        return $this;
    }

    /**
     * @param string $with
     * @param string $decimal
     * @param string $thousands
     * @return $this
     */
    public function rangeNumber( $with = '', $decimal = '.', $thousands = '' ): Column
    {
        $this->inputs['number']['enabled'] = true;
        $this->inputs['number']['with'] = $with;
        $this->inputs['number']['decimal'] = $decimal;
        $this->inputs['number']['thousands'] = $thousands;
        return $this;
    }

    /**
     * @param string $label
     * @return $this
     */
    public function clickToCopy( $label = 'copy' ): Column
    {
        $this->click_to_copy = [
            'label' => $label
        ];
        return $this;
    }

}
