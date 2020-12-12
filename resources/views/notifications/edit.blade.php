@extends('backend.master')
@section('content')

<div class="container-fluid">
   <div class="side-body">
      <div class="row">
         <div class="col-xs-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     <span class="title ">Edit Notification</span>
                     <!--<div class="description">Description</div>-->
                  </div>
               </div>
               <div class="card-body">
                  <h3>Edit Notification</h3>
                  <form method="POST" action="/backend/notifications/{{$postal->id}}" accept-charset="UTF-8" enctype="multipart/form-data">
                     <input name="_method" type="hidden" value="PATCH">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <a href="/backend/notifications" class="btn btn-primary">Back</a>
                     </div>
                     <div class="form-group">
                        <label for="NotificationTitle">Notification Title:</label>
                        <input class="form-control" name="notification_title" type="text" value="{{$notification->notification_title}}">
                     </div>
                     <div class="form-group">
                        <label for="NotificationBody">Notification Body:</label>
                        <input class="form-control" name="notification_body" type="text" value="{{$notification->notification_body}}">
                     </div>

                     <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Update">
                     </div>

                     @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection