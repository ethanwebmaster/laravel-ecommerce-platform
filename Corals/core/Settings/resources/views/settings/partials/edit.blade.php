<div class="row">
    <div class="col-md-12">
        @component('components.box')
            {!! Form::model($setting, ['url' => url($resource_url.'/'.$setting->hashed_id),'method'=>$setting->exists?'PUT':'POST','class'=>'ajax-form','files'=>true]) !!}
            @include('Settings::settings.partials.shared_fields',['setting' => $setting])

            @include('Settings::settings.types_value.'.strtolower($setting->type))

            {!! CoralsForm::customFields($setting,'col-md-12') !!}

            {!! CoralsForm::formButtons('<i class="fa fa-save"></i> ' . $title_singular, [], ['show_cancel' => false])  !!}

            {!! Form::close() !!}
        @endcomponent
    </div>
</div>