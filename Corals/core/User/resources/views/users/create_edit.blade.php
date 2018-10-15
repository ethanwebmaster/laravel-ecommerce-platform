@extends('layouts.crud.create_edit')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/authy-form-helpers/2.3/flags.authy.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/authy-form-helpers/2.3/form.authy.css"/>
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('user_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($user, ['url' => url($resource_url.'/'.$user->hashed_id),'method'=>$user->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row">
                    <div class="col-md-4">
                        {!! CoralsForm::text('name', 'User::attributes.user.name', true) !!}
                        {!! CoralsForm::email('email', 'User::attributes.user.email', true) !!}
                        {!! CoralsForm::password('password','User::attributes.user.password',!$user->exists) !!}
                        {!! CoralsForm::password('password_confirmation', 'User::attributes.user.password_confirmation' ,!$user->exists) !!}

                        @if(\TwoFactorAuth::isActive())
                            {!! CoralsForm::checkbox('two_factor_auth_enabled', 'User::attributes.user.two_factor_auth_enabled' ,\TwoFactorAuth::isEnabled($user)) !!}

                            @if(!empty(\TwoFactorAuth::getSupportedChannels()))
                                {!! CoralsForm::radio('channel', 'User::attributes.user.channel' , false,\TwoFactorAuth::getSupportedChannels(),array_get($user->getTwoFactorAuthProviderOptions(),'channel', null)) !!}
                            @endif
                        @endif
                    </div>
                    <div id="country-div" class="col-md-4">
                        {!! CoralsForm::text('job_title', 'User::attributes.user.job_title' ) !!}

                        {!! CoralsForm::text('phone_country_code', 'User::attributes.user.phone_country_code' ,true,null,['id'=>'authy-countries']) !!}
                        {!! CoralsForm::text('phone_number', 'User::attributes.user.phone_number' ,true,null,['id'=>'authy-cellphone']) !!}

                        {!! CoralsForm::checkboxes('roles[]', 'User::attributes.user.roles' ,true,\Roles::getRolesList(),$user->roles->pluck('id')->toArray()) !!}
                    </div>
                    <div class="col-md-4">
                        {!! CoralsForm::file('picture',  'User::attributes.user.picture' ) !!}

                        <img src="{{ $user->picture_thumb }}" class="img-circle img-responsive" width="150"
                             alt="User Picture"/>
                        @if($user->exists && $user->getFirstMedia('user-picture'))
                            {!! CoralsForm::checkbox('clear',  'User::attributes.user.default_picture' ) !!}
                        @endif
                    </div>
                </div>

                {!! CoralsForm::customFields($user) !!}

                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        {!! CoralsForm::formButtons() !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/authy-form-helpers/2.3/form.authy.js"></script>
    <script type="text/javascript">
        $('#country-div').bind("DOMSubtreeModified", function () {
            $(".countries-input").addClass('form-control');
        });
    </script>
@endsection