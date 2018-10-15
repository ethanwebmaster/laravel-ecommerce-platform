@extends('layouts.crud.create_edit')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('settings_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @component('components.box')
                {!! Form::model($setting, ['url' => url($resource_url.'/'.$setting->hashed_id),'method'=>$setting->exists?'PUT':'POST','class'=>'ajax-form']) !!}
                {{ Form::hidden('type', $type) }}
                @include('Settings::settings.partials.shared_fields',['setting' => $setting])
                {!! CoralsForm::formButtons() !!}
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection