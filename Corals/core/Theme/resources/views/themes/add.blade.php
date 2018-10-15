<div class="row">
    <div class="col-md-12">
        @component('components.box')
            {!! Form::open( ['url' => url($resource_url.'/add'),'method'=>'POST','files'=>true,'class'=>'ajax-form']) !!}
            {!! CoralsForm::file('theme','Theme::attributes.theme.theme_file', true) !!}
            {!! CoralsForm::checkbox('update_if_exist','Theme::attributes.theme.theme_update', false) !!}
            {!! CoralsForm::formButtons(trans('Theme::attributes.theme.theme_upload') . $title_singular, [], ['show_cancel'=>false]); !!}
            {!! Form::close() !!}
        @endcomponent
    </div>
</div>

<script>
    init_iCheck();
</script>