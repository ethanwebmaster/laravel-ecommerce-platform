<div class="row">
    <div class="col-md-12">
        @component('components.box')
            {!! Form::open( ['url' => url($resource_url.'/add'),'method'=>'POST','class'=>'ajax-form']) !!}

            {!! CoralsForm::text('module_key','Settings::attributes.module.code',true,'',
            ['help_text'=>'']) !!}

            {!! CoralsForm::text('license_key','Settings::attributes.module.license',true,'',['help_text'=>'']) !!}

            {!! CoralsForm::formButtons(trans('Settings::labels.module.download'). $title_singular, [], ['show_cancel'=>false]) !!}
            {!! Form::close() !!}
        @endcomponent
    </div>
</div>
