@admin
    @component('backend.link')
    @slot('link'){{ url('backend/admin') }}@endslot
    @slot('icon')icon fa fa-tachometer @endslot
    @slot('name')Dashboard @endslot
    @endcomponent
    @component('backend.link')
    @slot('link'){{ url('backend/articles') }}@endslot
    @slot('icon')icon fa fa-pencil-square-o @endslot
    @slot('name')Product @endslot
    @endcomponent
    @component('backend.link')
    @slot('link'){{ url('backend/users') }}@endslot
    @slot('icon')icon fa fa-user @endslot
    @slot('name')Manage Users @endslot
    @endcomponent
    @component('backend.link')
    @slot('link'){{ url('backend/orders') }}@endslot
    @slot('icon')icon fa fa-shopping-cart @endslot
    @slot('name')Orders @endslot
    @endcomponent
    @component('backend.link')
    @slot('link'){{ url('backend/brands') }}@endslot
    @slot('icon')icon fa fa-th-large @endslot
    @slot('name')Brands @endslot
    @endcomponent
    @component('backend.link')
    @slot('link'){{ url('backend/category') }}@endslot
    @slot('icon')icon fa fa-list @endslot
    @slot('name')Categories @endslot
    @endcomponent
    @component('backend.link')
    @slot('link'){{ url('backend/subcategory') }}@endslot
    @slot('icon')icon fa fa-list-alt @endslot
    @slot('name')Subcategories @endslot
    @endcomponent

    <li class="menu">
        <a href="/backend/postals">
            <span class="icon fa fa-th-large"></span><span class="title">Delivery Cost</span>
        </a>
    </li>

    <li class="menu">
        <a href="/backend/notifications/create">
            <span class="icon fa fa-th-large"></span><span class="title">Notifications</span>
        </a>
    </li>
    
    <li class="  panel panel-default dropdown">
    <a data-toggle="collapse" href="#dropdown-table">
        <span class="icon fa fa-table"></span><span class="title">Reports</span>
    </a>
    <!-- Dropdown-->
    <div id="dropdown-table" class="panel-collapse collapse">
        <div class="panel-body">
            <ul class="nav navbar-nav">
                <li><a href="/backend/dailyOrders">
                        <span class="icon fa fa-pencil-square-o"></span>Daily Reports</a>
                </li>
                <li><a href="/backend/weeklyOrders">
                        <span class="icon fa fa-pencil-square-o"></span>Weekly Reports</a>
                </li>
                <li><a href="/backend/monthlyOrders">
                        <span class="icon fa fa-pencil-square-o"></span>Monthly Reports</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End Dropdown-->
</li>
    
@endadmin
@user
    @component('backend.link')
    @slot('link'){{ url('backend/user') }}@endslot
    @slot('icon')icon fa fa-tachometer @endslot
    @slot('name')User Dashboard @endslot
    @endcomponent
    @component('backend.link')
    @slot('link'){{ url('backend/profile') }}@endslot
    @slot('icon')icon fa fa-eye @endslot
    @slot('name')User Profile @endslot
    @endcomponent
    @component('backend.link')
    @slot('link'){{ url('backend/user-orders') }}@endslot
    @slot('icon')icon fa fa-money @endslot
    @slot('name')My Orders @endslot
    @endcomponent
@enduser