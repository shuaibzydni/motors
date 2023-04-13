@extends('sellers.layouts.pricing_layout')

@section('pageName', 'Pricing Plan')

@section('content')
    <div class="pricing-chart-card">
        <div class="pricing-chart-lft">
            <div class="pricing-flow-part">
                <ul>
                    <li><span>1</span>
                        <p>Choose Plan</p>
                    </li>
                    <li><span>2</span>
                        <p>Payment Method</p>
                    </li>
                </ul>

            </div>
        </div>
        <div class="pricing-chart-rgt">
            @if($user)
                @if($user->currentSubscriptionPlan())
                    @if(!$user->currentSubscriptionPlan()->ends_at->isFuture() || $user->subscriptionPlanLimit() < 1)
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">You subscription limit is over or expired!</h4>
                            @if($user->currentSubscriptionPlan()->ends_at->isFuture())
                                <p>Hi, {{ $user->first_name }}. Your subscription <b>limit for bidding car is over. Kindly pick a plan</b></p>
                            @else
                                <p>Hi, {{ $user->first_name }}. Your subscription plan for bidding ended on <b>{{ $user->currentSubscriptionPlan()->ends_at }}. Kindly pick a plan</b></p>
                            @endif
                        </div>
                    @elseif($user->subscriptionPlanLimit() && $user->subscriptionPlanLimit() > 0)
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">You already have a active plan!</h4>
                            <p>Hi, {{ $user->first_name }}. You already have a active plan which currently have <b>{{ $user->subscriptionPlanLimit() }} bidding limits</b></p>
                        </div>
                    @endif
                @endif
            @endif
            <div class="pricing-chart-caption-sec">
                <div class="pc-caption-left">
                    <h2>Choose your plan</h2>
                    <p>Choose your comfort plan for the best usage</p>
                </div>
                <div class="pc-caption-right">
                    <a href="{{ route('buyer.pages.home') }}" class="shop-now">Skip Now</a>
                </div>
            </div>
            <div class="division-of-cards">
                @foreach($subscriptionPlans as $plan)
                <div class="div-cards">
                    <div class="div-cards-header">
                        <img src="{{ asset('static/sellers/images/card-2.png') }}" alt="card-2"/>
                        <h6>{{ $plan->name }}</h6>
                        <span><b>${{ $plan->cost }}</b> / {{ $plan->type }}</span>
                    </div>
                    <ul>
                        @foreach($plan->features as $feature)
                            <li>{{ $feature->features }}</li>
                        @endforeach
                    </ul>
                    @if($user)
                        @if($user->currentSubscriptionPlan())
                            @if($user->subscriptionPlanLimit() && $user->subscriptionPlanLimit() > 0)
                                <a href="#" @click.prevent="$_confirm('Plan exists', 'You already have active plan', 'warning', 'Close', false)" class="pick-a-plan pap-abs">Pick a Plan</a>
                            @endif
                            @if($user->subscriptionPlanLimit() && $user->subscriptionPlanLimit() < 1)
                                <a href="{{ route('buyer.pages.paymentMethods', ['slug' => $plan->slug]) }}" class="pick-a-plan pap-abs">Pick a Plan</a>
                            @endif
                            @if(!$user->currentSubscriptionPlan()->ends_at->isFuture() || $user->subscriptionPlanLimit() < 1)
                                <a href="{{ route('buyer.pages.paymentMethods', ['slug' => $plan->slug]) }}" class="pick-a-plan pap-abs">Pick a Plan</a>
                            @endif
                        @else
                            <a href="{{ route('buyer.pages.paymentMethods', ['slug' => $plan->slug]) }}" class="pick-a-plan pap-abs">Pick a Plan</a>
                        @endif
                    @else
                        <a href="{{ route('buyer.pages.paymentMethods', ['slug' => $plan->slug]) }}" class="pick-a-plan pap-abs">Pick a Plan</a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection
