@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('category_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @component('components.box')
                {!! Form::model($category, ['url' => url($resource_url.'/'.$category->hashed_id),'method'=>$category->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}

                {!! CoralsForm::text('name','CMS::attributes.category.name',true) !!}
                {!! CoralsForm::text('slug','CMS::attributes.category.slug',true) !!}
                {!! CoralsForm::radio('status','Corals::attributes.status',true, trans('Corals::attributes.status_options')) !!}
                @if (\Modules::isModuleActive('corals-subscriptions'))
                    {!! CoralsForm::select('subscription_plans[]','CMS::attributes.category.access_plans', [], false, null,
                    ['class'=>'select2-ajax','multiple'=>"multiple",'data'=>[
                    'model'=>\Corals\Modules\Subscriptions\Models\Plan::class,
                    'columns'=> json_encode(['name']),
                    'selected'=>json_encode($category->subscribable_plans(['getData'=>true])->pluck('id')->toArray()),
                    'where'=>json_encode([['field'=>'status','operation'=>'=','value'=>'active']]),
                    ]],'select2') !!}
                @endif

                {!! CoralsForm::customFields($category, 'col-md-12') !!}
                {!! CoralsForm::formButtons() !!}



                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@endsection