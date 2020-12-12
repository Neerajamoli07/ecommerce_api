@extends('backend.master')
@section('content')
<div class="container-fluid">
   <div class="side-body">
      <div class="row">
         <div class="col-xs-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     <span class="title ">Create Products</span>
                     <!--<div class="description">Description</div>-->
                  </div>
               </div>
               <div class="card-body">
                  <h3>Create Product</h3>
                  <form method="POST" action="/backend/postals" accept-charset="UTF-8" enctype="multipart/form-data">
                    {{ csrf_field() }}
                     <div class="form-group">
                        <a href="/backend/postal" class="btn btn-primary">Back</a>
                     </div>
                     <div class="form-group">
                        <label for="Name">Place Name:</label>
                        <input class="form-control" name="place_name" type="text">
                     </div>
                     <div class="form-group">
                        <label for="PinCode">Pin Code:</label>
                        <input class="form-control" name="pin_code" type="text">
                     </div>
                     <div class="form-group">
                        <label for="Distance">Distance:</label>
                        <input class="form-control" name="distance" type="text">
                     </div>
                     <div class="form-group">
                        <label for="DeliveryCost">Delivery Cost:</label>
                        <input class="form-control" name="deliver_cost" type="text">
                     </div>
                     <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Save">
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