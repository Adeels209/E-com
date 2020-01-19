<div class="col-md-3 col-sm-4 col-xs-12">
    <div class="idea-tab-menu">
        <ul class="nav idea-tab" role="tablist">
            <li ><a class="active" href="{{ route('user.dashboard', $user->id) }}">Personal Info</a></li>
            <li ><a href="{{ route('user.shipping.details', $user->id) }}" >Shipping Address</a></li>
            <li ><a href="{{ route('user.order') }}">My Order</a></li>
        </ul>
    </div>
</div>