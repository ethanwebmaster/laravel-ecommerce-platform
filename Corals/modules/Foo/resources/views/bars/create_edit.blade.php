@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('bar_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($bar, ['url' => url($resource_url.'/'.$bar->hashed_id),'method'=>$bar->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row">
                    <!-- place bar fields here-->
                </div>

                {!! CoralsForm::customFields($bar) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! CoralsForm::formButtons() !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@endsection