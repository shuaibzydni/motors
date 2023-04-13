@extends('buyers.layouts.buyer_layout')

@section('pageName', 'Terms and Condition')

@section('content')
@include('buyers.parts.header_nav')
    <div class="main_hdr sub_hdr">
        @include('buyers.parts.header_banner')
        <div class="hdr_ovly">
            <div class="container">
                <div class="hdr_section">
                    <div class="hdr_bnrcnt">
                        <h1>Notifications</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- terms&policy  -->
    <div class="trms_prlcwrp">
        <div class="container">
            <div class="prfle_stng">
                <div class="prfle_cnt2">
                    @forelse($notifications as $notification)
                        <div class="notifitcaion_mgs {{ $notification->is_read == "0" ? 'unread' : '' }}">
                            <div class="notification_title" >
                                <a href="{{ route('buyer.notification.redirect', ['notificationId' => $notification->id]) }}">
                                    <div class="notification_name">
                                        <h6>{{ $notification->title }}</h6>
                                        <p>{{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                    <p style="float: left">{{ $notification->notification_message }}</p>
                                </a>
                                @if($notification->is_read == "1")
                                    <a href="{{ route('buyer.notification.markAsRead', ['notificationId' => $notification->id]) }}">
                                        <span class="mark-badge" style="float: right">mark as unread</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="notifi-text unread">No notification found</div>
                    @endforelse
                </div>
                <div class="prfle_cnt2">
                    {!! $notifications->links() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- terms&policy  -->

@endsection
