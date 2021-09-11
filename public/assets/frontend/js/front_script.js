$(document).ready(function(){
    $(function () {
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
    });
    // filter product with reload
    // $("#sort").on('change',function(){
    //     this.form.submit();
    // });

    // filter products without reload
    $("#sort").on('change',function(){
    //   alert('test');
       var sort =$(this).val();
       var fabric =get_filter("fabric");
       var sleeve =get_filter("sleeve");
       var fit =get_filter("fit");
       var pattern =get_filter("pattern");
       var occasion =get_filter("occasion");
       var url =$("#url").val();
       $.ajax({
         url:url,
         method:"post",
         data:{sort:sort,url:url,fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion},
         success:function(data){
             $(".filter_products").html(data);
         }
       });
    });

    // side options filter
    $(".fabric").on('click',function(){
        var fabric =get_filter("fabric");
        var sleeve =get_filter("sleeve");
        var fit =get_filter("fit");
        var pattern =get_filter("pattern");
        var occasion =get_filter("occasion");
        var sort =$("#sort option:selected").val();
        var url =$("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{sort:sort,url:url,fabric:fabric,sleeve:sleeve,fit:fit,pattern:pattern,occasion:occasion},
            success:function(data){
                $(".filter_products").html(data);
            }
          });
    });

    $(".sleeve").on('click',function(){
        var fabric =get_filter("fabric");
        var sleeve =get_filter("sleeve");
        var fit =get_filter("fit");
        var pattern =get_filter("pattern");
        var occasion =get_filter("occasion");
        var sort =$("#sort option:selected").val();
        var url =$("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{sort:sort,url:url,fabric:fabric,sleeve:sleeve,fit:fit,pattern:pattern,occasion:occasion},
            success:function(data){
                $(".filter_products").html(data);
            }
          });
    });

    $(".fit").on('click',function(){
        var fabric =get_filter("fabric");
        var sleeve =get_filter("sleeve");
        var fit =get_filter("fit");
        var pattern =get_filter("pattern");
        var occasion =get_filter("occasion");
        var sort =$("#sort option:selected").val();
        var url =$("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{sort:sort,url:url,fabric:fabric,sleeve:sleeve,fit:fit,pattern:pattern,occasion:occasion},
            success:function(data){
                $(".filter_products").html(data);
            }
          });
    });
    $(".pattern").on('click',function(){
        var fabric =get_filter("fabric");
        var sleeve =get_filter("sleeve");
        var fit =get_filter("fit");
        var pattern =get_filter("pattern");
        var occasion =get_filter("occasion");
        var sort =$("#sort option:selected").val();
        var url =$("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{sort:sort,url:url,fabric:fabric,sleeve:sleeve,fit:fit,pattern:pattern,occasion:occasion},
            success:function(data){
                $(".filter_products").html(data);
            }
          });
    });
    $(".occasion").on('click',function(){
        var fabric =get_filter("fabric");
        var sleeve =get_filter("sleeve");
        var fit =get_filter("fit");
        var pattern =get_filter("pattern");
        var occasion =get_filter("occasion");
        var sort =$("#sort option:selected").val();
        var url =$("#url").val();
        $.ajax({
            url:url,
            method:"post",
            data:{sort:sort,url:url,fabric:fabric,sleeve:sleeve,fit:fit,pattern:pattern,occasion:occasion},
            success:function(data){
                $(".filter_products").html(data);
            }
          });
    });


    function get_filter(class_name){
       var filter=[];
        $('.'+class_name+':checked').each(function(){
             filter.push($(this).val());
        })
        return filter;
    }
    $("#getPrice").on("change",function(){
      var size = $(this).val();
      if(size==""){
          alert("Please select your size");
          return false;
      }
      var product_id = $(this).attr("product-id");
    //   alert(product_id);
      $.ajax({
          url:"/get-product-price",
          data:{size:size, product_id:product_id},
          type:'post',
          success:function(resp){
            // alert(resp['product_price']); return false;
            if(resp['final_price']> 0){
                $(".productPriceAttribute").html("<del> $. "+resp['product_price'] + "</del> $. "+resp['final_price'])
            }else{
                $(".productPriceAttribute").html("$. "+resp['product_price'])
            }

          },
          error:function(){
              alert("Filed");
          }
      });
    });

    // Update cart Items
    $(document).on("click",".btnItemUpdate",function(){
        if($(this).hasClass('qtyMinus')){
            var quantity =$(this).prev().val();
            if(quantity<1){
                alert("Minimum quantity is 1!");
                return false;
            }else{
                new_qty= parseInt(quantity)-1;
            }
        }
        if($(this).hasClass('qtyPlus')){
            var quantity = $(this).prev().prev().val();
            new_qty= parseInt(quantity)+1;
        }
        var cartId = $(this).data('cartid');
        // alert(cartId);
        $.ajax({
            data:{"cartId":cartId, "qty":new_qty},
            url:'/update-cart-item-quantity',
            type:'post',
            success:function(resp){
                if(resp.status==false){
                    alert('Asking amount is not available!');
                }
                $('.cartCountItems').html(resp.countCartItems);
                $("#appendCartItem").html(resp.view);
            },
            error:function(){
                alert("You have some issues!");
            }
        });
    });

    // Delete Cart Item

    $(document).on("click",".btnItemDelete", function(){
      var cartId = $(this).data('cartid');
      var result = confirm("Are you sure you want to delete this cart?");
      if(result){
            $.ajax({
                data:{"cartId":cartId},
                url:'/delete-cart-item',
                type:'post',
                success:function(resp){
                    $("#appendCartItem").html(resp.view);
                    $('.cartCountItems').html(resp.countCartItems);
                },
                error:function(){
                    alert("You have some issues!");
                }
            });
      }

    });

   $(document).on('click','.deleteAddress',function(){
     var result = confirm('Are you sure delete this address?');
     if(!result){
         return false;
     }else{
         return true;
     }
   });

    // Login / Register form validation
    // validate signup form on keyup and submit
    $("#registerForm").validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true,
                remote: "check-email"

            },
            mobile: {
                required: true,
                minlength: 11,
                maxlength: 14,
                digits:true,
            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            name: "Please enter your Name",
            email:{
                required: "Please provide an Email",
                email: "Please enter a valid email address",
                remote: "This email is already taken!",
            },
            mobile:{
                required: "Please enter a valid mobile number",
                minlength: "Mobile must be 14 characters",
                maxlength: "Phone must have 11 characters"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
        }
    });
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true,

            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            email:{
                required: "Please enter your Email",
                email: "Please enter a valid email address",
            },
            password: {
                required: "Please enter your password",
                minlength: "Your password must be at least 6 characters long"
            },
        }
    });

    // My Account form
    $("#accountForm").validate({
        rules: {
            mobile: {
                minlength: 11,
                maxlength: 11,
                digits:true,
            },
        },
        messages: {
            mobile:{
                minlength: "Mobile must be 11 characters",
                maxlength: "Phone must have 11 characters",
            },
        }
    });

    $(document).on("keyup","#current",function(){
        var current = $(this).val();
        $.ajax({
            type:'post',
            url: '/check-current-password',
            data:{current:current},
            success:function(resp){
                if(resp=="false"){
                    $('#pswd').html("<font color='red'>Password is Incorrect! </font> ");
                } else if(resp=="true"){
                $('#pswd').html("<font color='green'>Password Matched! </font> ");
                }
            },error:function(){
                alert("Error");
            }
        });
    });

    // Validate new password
    $("#updatePasswordForm").validate({
        rules: {
            current: {
                required: true,
            },
            new: {
                required: true,
                minlength: 6,
                maxlength: 20,
            },
            confirm: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo : "#new"
            },
        },
        messages: {
            current:{
                required: "Enter current password!",
            },
             new:{
                required: "Enter new password!",
                minlength: "Password minimum length is 6!",
                maxlength: "Password max length is 20!"
            },
            confirm:{
                required: "Enter confirm password!",
                minlength: "Password minimum length is 6!",
                maxlength: "Password max length is 20!",
                equalTo : "Password do not matched!"
            },
        }
    });

    // Apply coupon code
    $("#applyCoupon").on("submit", function(){
          var user = $(this).attr('user');
          if(user==1){
            var code = $("#code").val();
            // alert(code);
            $.ajax({
                type:'post',
                data:{code:code},
                url:'/apply-coupon',
                success:function(resp){
                   if(resp.massage != ""){
                      alert(resp.massage)
                   }
                   $('.cartCountItems').html(resp.countCartItems);
                   $("#appendCartItem").html(resp.view);

                   if(resp.couponAmount>=0){
                    $('.couponAmount').text("Rs."+resp.couponAmount);
                   }else{
                    $('.couponAmount').text("Rs. 0");
                   }

                   if(resp.grandTotal>=0){
                    $('.grandTotal').text("Rs."+resp.grandTotal);
                   }
                },
                error:function(resp){

                }
            });
          }else{
              alert('Please login first!');
              return false;
          }
    });

    $("input[name=address_id]").bind('change',function(){
        var shipping_charges = $(this).attr("shipping_charge");
        var total_price = $(this).attr("total_price");
        var coupon_amount = $(this).attr("coupon_amount");
        if(coupon_amount== ""){
            coupon_amount=0;
        }
        $(".shippingCharge").html("Rs."+shipping_charges);
        var grand_total = parseInt(total_price) + parseInt(shipping_charges) - parseInt(coupon_amount);
        // alert(grand_total);
        $(".grand_total").html("Rs."+grand_total);
    });

});
