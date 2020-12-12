@extends('backend.master')
@section('content')

<h1>Showing Notification {{ $notification->notification_id }}</h1>
<div class="jumbotron text-center">
    <p>
        <strong>Notification Title:</strong> {{ $notification->notification_title }}<br>
        <strong>Notification Body:</strong> {{ $notification->notification_body }}
    </p>
</div>
@endsection