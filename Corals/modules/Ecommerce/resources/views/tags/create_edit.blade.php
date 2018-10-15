@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('ecommerce_tag_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @component('components.box')
                {!! Form::model($tag, ['url' => url($resource_url.'/'.$tag->hashed_id),'method'=>$tag->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}

                {!! CoralsForm::text('name','Ecommerce::attributes.tag.name',true) !!}
                {!! CoralsForm::text('slug','Ecommerce::attributes.tag.slug',true) !!}
                {!! CoralsForm::radio('status','Corals::attributes.status', true, trans('Corals::attributes.status_options')) !!}
                {!! CoralsForm::customFields($tag, 'col-md-12') !!}
                {!! CoralsForm::formButtons() !!}

                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@endsection