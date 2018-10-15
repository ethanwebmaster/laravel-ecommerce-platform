@extends('layouts.master')

@section('editable_content')
    @php \Actions::do_action('pre_content',$item, $home??null) @endphp
    {!! $item->rendered !!}
    @include('partials.featured_categories')
    @include('partials.featured_products')
    @include('partials.three_column_lists')
    @include('partials.featured_brands')

    <section class="fw-section padding-top-2x padding-bottom-8x"
             style="background-image: url(/assets/themes/ecommerce-ultimate/img/background.jpg);"><span
                class="overlay" style="opacity: .5;"></span>
        <div class="container text-center">
            <div class="d-inline-block bg-danger text-white text-lg py-2 px-3 rounded">Limited Time Offer</div>
            <div class="pt-5"></div>
            <div class="countdown countdown-inverse" data-date-time="07/30/2018 12:00:00">
                <div class="item">
                    <div class="days">00</div>
                    <span class="days_ref">Days</span>
                </div>
                <div class="item">
                    <div class="hours">00</div>
                    <span class="hours_ref">Hours</span>
                </div>
                <div class="item">
                    <div class="minutes">00</div>
                    <span class="minutes_ref">Mins</span>
                </div>
                <div class="item">
                    <div class="seconds">00</div>
                    <span class="seconds_ref">Secs</span>
                </div>
            </div>
        </div>
    </section>


    <a class="d-block position-relative mx-auto" href="{{url('shop')}}"
       style="max-width: 682px; margin-top: -185px; z-index: 10;">
        <img class="d-block w-100" src="/assets/themes/ecommerce-ultimate/img/shop/products/bag.png" alt=""
             style="width: 200px!important;margin: 0 auto;">
    </a>

    <section class="container padding-top-2x padding-bottom-2x">
        <div class="row">
            <div class="col-md-3 col-sm-6 text-center mb-30"><img
                        class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3"
                        src="/assets/themes/ecommerce-ultimate/img/services/01.png"
                        alt="Shipping">
                <h6>@lang('corals-ecommerce-ultimate::labels.template.home.free_worldwide')</h6>
                <p class="text-muted margin-bottom-none">@lang('corals-ecommerce-ultimate::labels.template.home.free_shipping')</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center mb-30"><img
                        class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3"
                        src="/assets/themes/ecommerce-ultimate/img/services/02.png"
                        alt="Money Back">
                <h6>@lang('corals-ecommerce-ultimate::labels.template.home.money_back_guarantee')</h6>
                <p class="text-muted margin-bottom-none">@lang('corals-ecommerce-ultimate::labels.template.home.money_days')</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center mb-30"><img
                        class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3"
                        src="/assets/themes/ecommerce-ultimate/img/services/03.png"
                        alt="Support">
                <h6>@lang('corals-ecommerce-ultimate::labels.template.home.customer_support')</h6>
                <p class="text-muted margin-bottom-none">@lang('corals-ecommerce-ultimate::labels.template.home.friendly_customer_support')</p>
            </div>
            <div class="col-md-3 col-sm-6 text-center mb-30"><img
                        class="d-block w-90 img-thumbnail rounded-circle mx-auto mb-3"
                        src="/assets/themes/ecommerce-ultimate/img/services/04.png"
                        alt="Payment">
                <h6>@lang('corals-ecommerce-ultimate::labels.template.home.secure_online_payment')</h6>
                <p class="text-muted margin-bottom-none">@lang('corals-ecommerce-ultimate::labels.template.home.posess_ssl')</p>
            </div>
        </div>
        <div class="text-center">
            @php \Actions::do_action('pre_display_footer') @endphp
        </div>
    </section>
@stop
@section('js')
    @parent
    @include('Ecommerce::cart.cart_script')
@endsection