// $(function(){
//     $('#current').keyup(function(){
//         var current= $("#current").val();
//         // alert(current);
//         $.ajax({
//             type:"post",
//             url:"admin/check-pswd",
//             data:{current:current},
//             success:function(resp){
//                 alert(resp);
//             },error:function(){
//                 alert("Error");
//             }
//         })
//     })
// });





// Password Confirmation and validation

jQuery(function(){
    $("#submit").click(function(){
    $(".error").hide();
    var hasError = false;
    var currentVal = $("#current").val();
    var passwordVal = $("#new").val();
    var checkVal = $("#confirm").val();
     if (currentVal == '') {
        $("#current").after('<span class="error" style="color:red">Enter your old password</span>');
        hasError = true;
    }
     else if (passwordVal == '') {
        $("#new").after('<span class="error" style="color:red">Please enter a password.</span>');
        hasError = true;
    }else if (checkVal == '') {
        $("#confirm").after('<span class="error" style="color:red">Please re-enter your password.</span>');
        hasError = true;
    }else if (passwordVal != checkVal ) {
        $("#confirm").after('<span class="error" style="color:red">Passwords do not match.</span>');
        hasError = true;
    }
    if(hasError == true) {return false;}
});





// Update Section Status
$(document).on("click",".updateSectionStatus",function(){
    var status = $(this).children("i").attr("status");
    var section_id = $(this).attr("section_id");
    $.ajax({
      type:'post',
      url: '/admin/update-section-status',
      data:{status:status, section_id:section_id},
      success:function(resp){
         if(resp['status']==0){
             $('#section-'+section_id).html("<i class='fas fa-toggle-off' status='Disabled'></i>");
         }else if(resp['status']==1){
            $('#section-'+section_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
        }
      },error:function () {
        alert("Error");
       }
    });
  });


//   Update Category Status
$(document).on("click",".updateCategoryStatus",function(){
// $(".updateCategoryStatus").click(function(){
    var status = $(this).children("i").attr("status");
    var category_id = $(this).attr("category_id");
    $.ajax({
      type:'post',
      url: '/admin/update-category-status',
      data:{status:status, category_id:category_id},
      success:function(resp){
         if(resp['status']==0){
             $('#category-'+category_id).html("<i class='updateCategoryStatus' status='Disabled'></i>");
         }else if(resp['status']==1){
            $('#category-'+category_id).html("<i class='updateCategoryStatus' status='Active'></i>");
        }
      },error:function () {
        alert("Error");
       }
    });
  });
// Update Products Status
$(document).on("click",".updateProductStatus",function(){
// $(".updateProductStatus").click(function(){
    var status= $(this).text();
    var product_id=$(this).attr("product_id");
    $.ajax({
        type:'post',
        url:'/product/update-product-status',
        data:{status:status,product_id:product_id},
        success:function(resp){
            if(resp['status']==0){
                $('#product-'+product_id).html("Make Active");
            }else if(resp['status']==1){
                $('#product-'+product_id).html("Active");
            }
        },error:function(){
           alert("Error");
        }
    })
})

//   Update category level

  $('#section_id').on("change",function(){
      var section_id = $(this).val();
      $.ajax({
          type:'post',
          url:'/admin/append-category-level',
          data:{section_id:section_id},
          success:function(resp){
             $('.appendCategoryLevel').html(resp);
          },error:function(){
             alert("Error");
          }
      })
  });

//   Confirmation Delete

//   $(".confirmDelete").click(function(){
//      var name =$(this).attr("name");
//      if(confirm("Are you sure you want to delete this" +name+ "?")){
//         return true;
//      }else {
//          return false;
//      }
//   });

//   Confirm Delete with SweetAlert 2
        //  pagination problem solve
        // $(".confirmDelete").click(function()){
        $(document).on("click",".confirmDelete",function(){
            var record =$(this).attr("record");
            var recordid =$(this).attr("recordid");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href="/delete-"+record+"/"+recordid;
                }
              })
        });
        $(document).on("click",".deleteProduct",function(){
            var record =$(this).attr("record");
            var recordid =$(this).attr("recordid");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href="/product/delete-"+record+"/"+recordid;
                }
              })
        });

        // Update Attribute Status
        $(document).on("click",".updateAttributeStatus",function(){
        // $(".updateAttributeStatus").click(function(){
            var status= $(this).text();
            var attribute_id=$(this).attr("attribute_id");
            $.ajax({
                type:'post',
                url:'/product/update-attribute-status',
                data:{status:status,attribute_id:attribute_id},
                success:function(resp){
                    if(resp['status']==0){
                        $('#attribute-'+attribute_id).html("Disabled");
                    }else if(resp['status']==1){
                        $('#attribute-'+attribute_id).html("Active");
                    }
                },error:function(){
                alert("Error");
                }
            })
        })

 // Update Product Images Status
    $(document).on("click",".updateProductImages",function(){
    // $(".updateProductImages").click(function(){
        var status= $(this).text();
        var image_id=$(this).attr("image_id");
        $.ajax({
            type:'post',
            url:'/product/update-image-status',
            data:{status:status,image_id:image_id},
            success:function(resp){
                if(resp['status']==0){
                    $('#image-'+image_id).html("Disabled");
                }else if(resp['status']==1){
                    $('#image-'+image_id).html("Active");
                }
            },error:function(){
            alert("Error");
            }
        })
    })

    // Update Brands Status
    $(document).on("click",".updateBrandStatus",function(){
    // $(".updateBrandstatus").click(function(){
       var status =$(this).children("i").attr("status");
       var brands_id= $(this).attr('brands_id');
       $.ajax({
           type:'post',
           url:'/admin/update-brands-status',
           data:{status:status, brands_id:brands_id},
           success:function(resp){
                if(resp['status']==0){
                    $('#brands-'+brands_id).html("<i class=' fas fa-toggle-off text-danger' status='Disable'></i>");
                }else if(resp['status']==1){
                    $('#brands-'+brands_id).html("<i class=' fas fa-toggle-on text-success' status='Active'></i>");
                }
            },error:function(){
               alert("Error!");
           }
       })
    });

    // Update Banner Status
    $(document).on("click",".updateBannerStatus",function(){
        // $(".updateBrandstatus").click(function(){
           var status =$(this).children("i").attr("status");
           var banner_id= $(this).attr('banner_id');
           $.ajax({
               type:'post',
               url:'/admin/update-banner-status',
               data:{status:status, banner_id:banner_id},
               success:function(resp){
                    if(resp['status']==0){
                        $('#banner-'+banner_id).html("<i class='fas fa-toggle-off' status='Disable'></i>");
                    }else if(resp['status']==1){
                        $('#banner-'+banner_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                    }
                },error:function(){
                   alert("Error!");
               }
           })
        });

         // Update Coupon Status
    $(document).on("click",".updateCouponStatus",function(){
           var status =$(this).children("i").attr("status");
           var coupon_id= $(this).attr('coupon_id');
           $.ajax({
               type:'post',
               url:'/admin/update-coupon-status',
               data:{status:status, coupon_id:coupon_id},
               success:function(resp){
                    if(resp['status']==0){
                        $('#coupon-'+coupon_id).html("<i class='fas fa-toggle-off' status='Disable'></i>");
                    }else if(resp['status']==1){
                        $('#coupon-'+coupon_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                    }
                },error:function(){
                   alert("Error!");
               }
           })
        });
        // Update Coupon Status
        $(document).on("click",".updateShippingStatus",function(){
            var status =$(this).children("i").attr("status");
            var shipping_id= $(this).attr('shipping_id');
            $.ajax({
                type:'post',
                url:'/admin/update-shipping-status',
                data:{status:status, shipping_id:shipping_id},
                success:function(resp){
                    if(resp['status']==0){
                        $('#shipping-'+shipping_id).html("<i class='fas fa-toggle-off' status='Disable'></i>");
                    }else if(resp['status']==1){
                        $('#shipping'+shipping_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                    }
                },error:function(){
                    alert("Error!");
                }
            })
        });
        // Update Coupon Status
        $(document).on("click",".updateCmsStatus",function(){
        var status =$(this).children("i").attr("status");
        var cms_id= $(this).attr('cms_id');
        $.ajax({
            type:'post',
            url:'/admin/update-cms-status',
            data:{status:status, cms_id:cms_id},
            success:function(resp){
                if(resp['status']==0){
                    $('#cms-'+cms_id).html("<i class='fas fa-toggle-off' status='Disable'></i>");
                }else if(resp['status']==1){
                    $('#cms'+cms_id).html("<i class='fas fa-toggle-on' status='Active'></i>");
                }
            },error:function(){
                alert("Error!");
            }
        })
        });




        // Add edit Attribute
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div style="margin-top:20px;"> <input type="text" name="size[]"  placeholder="Size" required/> <input type="number" name="price[]"  placeholder="Price" required/> <input type="number" name="stock[]"  placeholder="Stock" required/> <input type="text" name="sku[]"  placeholder="SKU" required/> <a href="javascript:void(0);" class="remove_button">Delete</a></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });


    // Hide and show manual coupon field
        $(document).on('click','#ManualCoupon',function(){
            $('#CouponField').show();
    });

    $(document).on('click','#AutomaticCoupon',function(){
        $('#CouponField').hide();
    });

    $('#courier_name').hide();
    $('#tracking_number').hide();

    $(document).on('change','#order_status',function(){
        // alert(this.value); die;
        if(this.value== "Shipped"){
            $('#courier_name').show();
            $('#tracking_number').show();
        }
    });
 });
