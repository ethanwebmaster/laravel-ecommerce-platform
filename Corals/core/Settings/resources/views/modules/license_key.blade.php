@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($module, ['url' => url($resource_url.'/'.$module->hashed_id.'/license-key'),'method'=>'PUT','files'=>false,'class'=>'ajax-form']) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! CoralsForm::text('license_key','Settings::labels.module.license_key',true,$module->license_key,
                        ['help_text'=>'']) !!}
                        {!! CoralsForm::formButtons(trans('Settings::labels.module.license_update') . $title_singular, [], ['show_cancel' => false])  !!}
                    </div>

                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
