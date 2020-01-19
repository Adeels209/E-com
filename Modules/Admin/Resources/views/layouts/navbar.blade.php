<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row position-relative">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html"><img class="brand-logo" alt="modern admin logo" src="{{ URL::to('admin_ui/images/logo/logo.png') }}">
                        <h3 class="brand-text">Modern Admin</h3></a></li>
                <li class="nav-item d-none d-md-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
            </ul>
        </div>

        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">

                        <div class="search-input">
                            <input class="input" type="text" placeholder="Explore Modern...">
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1">Hello,<span class="user-name text-bold-700">{{ Auth::user('admin')->name }}</span></span><span class="avatar avatar-online"><img src="{{ URL::to('admin_ui/images/portrait/small/avatar-s-19.png') }}" alt="avatar"><i></i></span></a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#"><i class="ft-user"></i> Edit Profile</a><a class="dropdown-item" href="#"><i class="ft-mail"></i> My Inbox</a><a class="dropdown-item" href="#"><i class="ft-check-square"></i> Task</a><a class="dropdown-item" href="#"><i class="ft-message-square"></i> Chats</a>
                            <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="ft-power"></i> Logout</a>
                        </div>
                    </li>

                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown" onclick="markAsRead()"><i  class="ficon ft-bell" ></i><div id="markAsRead"><span  class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" >{{ Auth::guard('admin')->user()->unReadNotifications->count() }}</span></div></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6><span class="notification-tag badge badge-default badge-danger float-right m-0" id="new">{{ Auth::guard('admin')->user()->unReadNotifications->count() }} New</span>
                            </li>
                            <li class="scrollable-container media-list w-100">
                                <a href="javascript:void(0)">
                                    @if(isset(Auth::guard('admin')->user()->unreadNotifications))
                                        @foreach(Auth::guard('admin')->user()->unreadNotifications as $notification)
                                            {{--                                            @if($notification->type == 'App\Notifications\NotifyLowQuantity')--}}
                                            <div class="media" style="" id="media">
                                                <div class="media-left align-self-center"><i @if($notification->type == 'App\Notifications\NotifyLowQuantity') style="color: lightskyblue;" @elseif($notification->type == 'App\Notifications\ProductIsOutOfStock') style="color: red;" @elseif($notification->type == 'App\Notifications\OrderSuccessNotification') style="color: green;" @endif class="@if($notification->type == 'App\Notifications\NotifyLowQuantity') ft-alert-triangle @elseif($notification->type == 'App\Notifications\ProductIsOutOfStock') ft-alert-octagon @elseif($notification->type == 'App\Notifications\OrderSuccessNotification') ft-thumbs-up @endif "></i></div>
                                                <div class="media-body">
                                                    <a href="@if($notification->type == 'App\Notifications\NotifyLowQuantity'){{route('admin.stock.check', $notification->id)}} @elseif($notification->type == 'App\Notifications\ProductIsOutOfStock') {{route('admin.stock.check', $notification->id)}} @elseif($notification->type == 'App\Notifications\OrderSuccessNotification') {{ route('admin.order.check', $notification->id) }} @endif"><h6 class="media-heading">@if($notification->type == 'App\Notifications\NotifyLowQuantity') <strong>Warning!</strong> @elseif($notification->type == 'App\Notifications\ProductIsOutOfStock') <strong>ALERT</strong>  @elseif($notification->type == 'App\Notifications\OrderSuccessNotification') <strong> WOLLAH </strong> @endif</h6>
                                                        <p class="notification-text font-small-3 text-muted">@if($notification->type == 'App\Notifications\NotifyLowQuantity') {{ $notification->data['product']['name'] }} contains less then 5 quantity left.  @elseif($notification->type == 'App\Notifications\ProductIsOutOfStock') {{ $notification->data['product']['name'] }} is  <strong> OUT OF STOCK! </strong> @elseif($notification->type == 'App\Notifications\OrderSuccessNotification') There's a new order from customer named <strong>{{ $notification->data['product']['fname'] }}.</strong>   @endif</p></a><small>
                                                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">@if($notification->type == 'App\Notifications\NotifyLowQuantity'){{  $notification->created_at->diffForHumans() }} @elseif($notification->type == 'App\Notifications\ProductIsOutOfStock') {{ $notification->created_at->diffForHumans() }} @elseif($notification->type == 'App\Notifications\OrderSuccessNotification') {{ $notification->created_at->diffForHumans() }} @endif</time></small>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </a>
                                <a href="javascript:void(0)">
                                    @if(isset(Auth::guard('admin')->user()->readNotifications))
                                        @foreach(Auth::guard('admin')->user()->readNotifications as $notification)
                                        <div class="media">
                                            <div class="media-left align-self-center"><i @if($notification->type == 'App\Notifications\NotifyLowQuantity') style="color: lightskyblue;" @elseif($notification->type == 'App\Notifications\ProductIsOutOfStock') style="color: red;" @elseif($notification->type == 'App\Notifications\OrderSuccessNotification') style="color: green;" @endif class="@if($notification->type == 'App\Notifications\NotifyLowQuantity') ft-alert-triangle @elseif($notification->type == 'App\Notifications\ProductIsOutOfStock') ft-alert-octagon @elseif($notification->type == 'App\Notifications\OrderSuccessNotification') ft-thumbs-up @endif "></i></div>
                                                <div class="media-body">
                                                    <a href="@if($notification->type == 'App\Notifications\NotifyLowQuantity'){{route('admin.stock.check', $notification->id)}} @elseif($notification->type == 'App\Notifications\ProductIsOutOfStock') {{route('admin.stock.check', $notification->id)}} @elseif($notification->type == 'App\Notifications\OrderSuccessNotification') {{ route('admin.order.index', $notification->id) }} @endif"><h6 class="media-heading">@if($notification->type == 'App\Notifications\NotifyLowQuantity') <strong>Warning!</strong> @elseif($notification->type == 'App\Notifications\ProductIsOutOfStock') <strong>ALERT</strong>  @elseif($notification->type == 'App\Notifications\OrderSuccessNotification') <strong> WOLLAH </strong> @endif</h6>
                                                         <p class="notification-text font-small-3 text-muted">@if($notification->type == 'App\Notifications\NotifyLowQuantity') {{ $notification->data['product']['name'] }} contains less then 5 stock remaining.  @elseif($notification->type == 'App\Notifications\ProductIsOutOfStock') {{ $notification->data['product']['name'] }} is  <strong> OUT OF STOCK! </strong> @elseif($notification->type == 'App\Notifications\OrderSuccessNotification') There's a new order from customer named <strong>{{ $notification->data['product']['fname'] }}.</strong>   @endif</p></a><small>
                                                    <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">@if($notification->type == 'App\Notifications\NotifyLowQuantity'){{  $notification->created_at->diffForHumans() }} @elseif($notification->type == 'App\Notifications\ProductIsOutOfStock') {{ $notification->created_at->diffForHumans() }} @elseif($notification->type == 'App\Notifications\OrderSuccessNotification') {{ $notification->created_at->diffForHumans() }} @endif</time></small>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </a>
                                <a href="javascript:void(0)"></a>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


