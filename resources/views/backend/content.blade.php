<link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css')}}">
@extends('backend/tblTemplate')
@section('title',$title)
@section('body')
    @if(isset($edit))
        {!! $edit !!}
    @elseif(isset($filter))
        {!! $filter !!}
        {!! $grid !!}
    @else
        {!! $grid !!}
    @endif
    @include('errors.error_layout')
    <a href="#myModal" class="btn btn-lg btn-primary" data-toggle="modal">Launch Demo Modal</a>
    
<!-- Modal HTML -->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="margin:auto;display:table;color:green;">Order Items</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id='orderItems'>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $.noConflict();
    $(document).on('click','tr',function(){
        let data = $(this).find("td:eq(0)").text();
        
        $(this).find("td:eq(0)").css("color","red");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/userOrderItem/"+data,
            success: function (data) { 
                orderItem = data.data;
                itemLength = orderItem.length;
                console.log("Neeraj ",orderItem);
                console.log("Neeraj ", itemLength);
                html = '';
                for(i=0;i<itemLength;i++){
                  html +='<p>Id:  ' +orderItem[i]['id'] + '</p>'+
                         '<p>Order Id:  '  +orderItem[i]['order_id'] + '</p>'+
                         '<p>Product Id:  ' + orderItem[i]['product_id'] + '</p>'+
                         '<p>Product Name:  ' +orderItem[i]['product_name'] + '</p>'+
                         '<p>Product Price:  ' +orderItem[i]['product_price'] + '</p>'+
                         '<p>Product Quantity:  ' +orderItem[i]['product_quantity'] + '</p>'+
                         '<p>Additional Info:  ' +orderItem[i]['additional_info'] + '</p>'+
                         '<br>'
                }
                $('#orderItems').html('');
                $('#orderItems').html(html);
                $('#myModal').modal('show');
            },
            error: function (data) { 
                console.log("Amoli ",data);
            }
        });
    })
})
</script>
@endsection



