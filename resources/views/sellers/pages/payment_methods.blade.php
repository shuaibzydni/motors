@extends('sellers.layouts.pricing_layout')

@section('pageName', 'Payment Methods')

@section('content')
    <div class="pricing-chart-card pcc-pay-method">
        <div class="pricing-chart-lft">
            <div class="pricing-flow-part">
                <ul>
                    <li class="active"><span><i class="fa fa-check" aria-hidden="true"></i></span>
                        <p>Choose Plan</p>
                    </li>
                    <li><span>2</span>
                        <p>Payment Method</p>
                    </li>
                </ul>

            </div>
        </div>
        <div class="pricing-chart-rgt">
            <div class="pricing-chart-caption-sec">
                <div class="pc-caption-left">
                    <h2>Choose your plan</h2>
                    <p>Choose your comfort plan for the best usage</p>
                </div>
                <div class="pc-caption-right">
                    <a href="{{ route('seller.pages.home') }}" class="shop-now">Skip Now</a>
                </div>
            </div>
            <div class="division-of-cards division-method-rs">
                <div class="div-cards-prnt">
                    <h5>Selected Plan</h5>
                    <div class="div-cards div-cards-red">
                        <div class="div-cards-header">
                            <img src="{{ asset('static/sellers/images/card-3.png') }}" alt="card-3"/>
                            <h6>{{ $plan->name }}</h6>
                            <span><b>${{ $plan->cost }}</b> / {{ $plan->type }}</span>
                        </div>
                        <ul>
                            @foreach($plan->features as $feature)
                                <li>{{ $feature->features }}</li>
                            @endforeach
                        </ul>
                        <a href="{{ route('seller.pages.pricingPlan') }}" class="pick-a-plan pap-abs change-plan">Change Plan</a>
                    </div>
                </div>

                <div class="pay-method-option">
                    <div class="div-cards-rgt-side">
                        <div class="div-cards-prnt-left">
                            <div class="card-type-section">
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <p>{{ Session::get('success') }}</p>
                                        <p><a href="{{ route('seller.pages.home') }}">Go back to Homepage</a></p>
                                    </div>
                                @endif
                                <h5>Payment Options</h5>
                                <div class="payment-select-prnt">
                                    <div class="payment-selection">
                                        <div class="credit-selection active">
                                            <div class="form-group">
                                                <h4>Credit / Debit / ATM Card</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-credentials w-100">
                                        <form
                                            style="width: 100%"
                                            role="form"
                                            action="{{ route('seller.subscription.create', ['plan' => $plan->id]) }}"
                                            method="post"
                                            class="require-validation"
                                            data-cc-on-file="false"
                                            data-stripe-publishable-key="{{ config('cashier.key') }}"
                                            id="payment-form">
                                            @csrf

                                            <div class='form-row row'>
                                                <div class='col-xs-12 form-group required'>
                                                    <label class='control-label'>Name on Card</label> <input
                                                        class='form-control' size='4' type='text'>
                                                </div>
                                            </div>

                                            <div class='form-row row'>
                                                <div class='col-xs-12 form-group card required'>
                                                    <label class='control-label'>Card Number</label> <input
                                                        autocomplete='off' class='form-control card-number' size='20'
                                                        type='text'>
                                                </div>
                                            </div>

                                            <div class='form-row row'>
                                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                    <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                                                                    type='text'>
                                                </div>
                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                    <label class='control-label'>Exp. Month</label> <input
                                                        class='form-control card-expiry-month' placeholder='MM' size='2'
                                                        type='text'>
                                                </div>
                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                    <label class='control-label'>Exp. Year</label> <input
                                                        class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                        type='text'>
                                                </div>
                                            </div>

                                            <div class='form-row row'>
                                                <div class='col-md-12 error form-group hide'>
                                                    <div class='alert-danger alert'>Please correct the errors and try
                                                        again.</div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (${{ number_format($plan->cost, 2) }})</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function() {

            var $form         = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form         = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs       = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid         = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
@endpush

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style type="text/css">
        .form-group input {
            padding: 6px 12px !important;
            width: 100% !important;
            display: block !important;
            cursor: auto !important;
        }
        .form-group label:before {
            content: unset !important;
        }
    </style>
@endsection
