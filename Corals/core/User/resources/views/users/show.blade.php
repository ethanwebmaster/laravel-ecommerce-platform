@extends('layouts.crud.show')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot

        @slot('breadcrumb')
            {{ Breadcrumbs::render('user_show') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            @component('components.box',['box_class'=>'box-success'])
                <div style="font-size: medium">
                    {!! $user->present('action') !!}
                </div>

                <img style="width: 60%;margin: 0 auto;"
                     class="img-responsive img-circle"
                     src="{{ asset($user->picture) }}"
                     alt="User profile picture">

                <p class="profile-username text-center">{{ $user->name }}</p>
                <p class="text-center">{{ $user->present('email') }}</p>
                <p class="text-center">Since {{ format_date($user->created_at) }}</p>
                <p class="text-center">
                    {!! formatArrayAsLabels($user->roles->pluck('label'),'success') !!}
                </p>
                <p class="text-center">
                    {{ $user->job_title }}
                </p>
                <p class="text-center">
                    {{ $user->phone }}
                </p>
            @endcomponent
        </div>
        @php \Actions::do_action('display_profile',$user) @endphp

    </div>
@endsection