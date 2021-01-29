@extends('backend.master')
@section('content')

<div class="container-fluid">
   <div class="side-body">
      <div class="row">
         <div class="col-xs-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     <span class="title ">Notifications</span>
                     <!--<div class="description">Description</div>-->
                  </div>
               </div>
               <div class="card-body">
                  <a href="/backend/notifications/create" class="btn btn-success">Send Notification </a>
                  <hr>
                  <table class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr class="bg-info">
                           <th>ID</th>
                           <!-- <th>Slug</th> -->
                           <th>Notification Title</th>
                           <th>Notification Body</th>
                           <th colspan="3">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                     @foreach($notifications as $key => $value)
                        <tr>
                           <td>{{ $value->id }}</td>
                           <td>{{ $value->notification_title }}</td>
                           <td>{{ $value->notification_body }}</td>
                           <!-- <td><a href="/backend/articles/1" class="btn btn-primary">Read</a></td> -->
                           <td><a href="/backend/notifications/{{ $value->id }}/edit" class="btn btn-warning">Update</a></td>
                           <td>
                              <form method="POST" action="/backend/notifications/{{ $value->id }}" accept-charset="UTF-8">
                                <input name="_method" type="hidden" value="DELETE">
                                {{ csrf_field() }}
                                 <input class="btn btn-danger" type="submit" value="Delete">
                              </form>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  {{ $notifications->links() }}
                  
                  <div class="row">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
