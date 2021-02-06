<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/bootstrap.min.css')); ?>">

<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('body'); ?>
    <?php if(isset($edit)): ?>
        <?php echo $edit; ?>

    <?php elseif(isset($filter)): ?>
        <?php echo $filter; ?>

        <?php echo $grid; ?>

    <?php else: ?>
        <?php echo $grid; ?>

    <?php endif; ?>
    <?php echo $__env->make('errors.error_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
        let order_id = $(this).find("td:eq(0)").text();
        
        $(this).find("td:eq(0)").css("color","red");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/userOrderItem/"+order_id,
            success: function (data) { 
                console.log("NEERAJ ",data);
                orderItem = data.data;
                delivery_user = data.delivery_users_ids;

                itemLength = orderItem.length;
                delivery_user_length = delivery_user.length;

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
                
                option = '<select id="delivery_user" data-order_id="'+ order_id+'"><option value="">Select</option>';
                for(j=0;j<delivery_user_length;j++){
                    option +='<option value="'+ delivery_user[j]['id'] +'">' +delivery_user[j]['name'] + '</option>'
                }
                option += '<select>';
                html += '<p>Select Delivery Boy:  ' + option + '</p>'
                console.log("Neeraj ",option);
                $('#orderItems').html('');
                $('#orderItems').html(html);
                $('#myModal').modal('show');
            },
            error: function (data) { 
                console.log("Amoli ",data);
            }
        });
    })

   //map delivery user id to order id
   $(document).on('change','#delivery_user',function(){
     let user_id = $(this).val();
     let order_id = $('#delivery_user').data('order_id');
     let _token   = $('meta[name="csrf-token"]').attr('content');

     $.ajax({
            type: "POST",
            dataType: "json",
            url: "/update_delivery_user",
            data: {_token: _token,order_id: order_id, user_id: user_id},
            success: function (data) { 
                console.log("AMOLI ",data);
                if(data){
                 alert(data.msg);
                }
                
            },
            error: function (data) { 
                console.log("Amoli ",data);
            }
        });
   });

})
</script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('backend/tblTemplate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>