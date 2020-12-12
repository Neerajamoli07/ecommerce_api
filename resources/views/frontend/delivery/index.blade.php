@extends('backend.master')
@section('content')

<div class="container-fluid">
   <div class="side-body">
      <div class="row">
         <div class="col-xs-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     <span class="title ">Delivery Cost</span>
                     <!--<div class="description">Description</div>-->
                  </div>
               </div>
               <div class="card-body">
                  <a href="/backend/postals/create" class="btn btn-success">Add Delivery </a>
                  <hr>
                  <table class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr class="bg-info">
                           <th>ID</th>
                           <!-- <th>Slug</th> -->
                           <th>Place Name</th>
                           <th>Distance</th>
                           <th>Pin Code</th>
                           <th>Delivery Cost</th>
                           <th colspan="3">Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                     @foreach($postals as $key => $value)
                        <tr>
                           <td>{{ $value->id }}</td>
                           <td>{{ $value->place_name }}</td>
                           <td>{{ $value->distance }}</td>
                           <td>{{ $value->pin_code }}</td>
                           <td>{{ $value->deliver_cost }}</td>
                           <!-- <td><a href="/backend/articles/1" class="btn btn-primary">Read</a></td> -->
                           <td><a href="/backend/postals/{{ $value->id }}/edit" class="btn btn-warning">Update</a></td>
                           <td>
                              <form method="POST" action="/backend/postals/{{ $value->id }}" accept-charset="UTF-8">
                                <input name="_method" type="hidden" value="DELETE">
                                {{ csrf_field() }}
                                 <input class="btn btn-danger" type="submit" value="Delete">
                              </form>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>

                  
                  <div class="row">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection