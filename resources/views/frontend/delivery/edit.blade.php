@extends('backend.master')
@section('content')

<div class="container-fluid">
   <div class="side-body">
      <div class="row">
         <div class="col-xs-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     <span class="title ">Edit Delivery Cost</span>
                     <!--<div class="description">Description</div>-->
                  </div>
               </div>
               <div class="card-body">
                  <h3>Edit Product</h3>
                  <form method="POST" action="/backend/postals/{{$postal->id}}" accept-charset="UTF-8" enctype="multipart/form-data">
                     <input name="_method" type="hidden" value="PATCH">
                     {{ csrf_field() }}
                     <div class="form-group">
                        <a href="/backend/postals" class="btn btn-primary">Back</a>
                     </div>
                     <div class="form-group">
                        <label for="PlaceName">Place Name:</label>
                        <input class="form-control" name="place_name" type="text" value="{{$postal->place_name}}">
                     </div>
                     <div class="form-group">
                        <label for="Distance">Distance:</label>
                        <input class="form-control" name="distance" type="text" value="{{$postal->distance}}">
                     </div>
                     <div class="form-group">
                        <label for="Pin Code">Pin Code:</label>
                        <input class="form-control" name="pin_code" type="text" value="{{$postal->pin_code}}">
                     </div>
                     <div class="form-group">
                        <label for="DeliveryCost">DeliverCost:</label>
                        <input class="form-control" name="deliver_cost" type="text" value="{{$postal->deliver_cost}}">
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