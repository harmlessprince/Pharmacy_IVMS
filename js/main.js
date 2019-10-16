
$(document).ready(function(){ 

    var DOMAIN = "http://localhost:8080/ivm/public_html";


    //fetch category 
    fetch_category();
    function fetch_category(){
        $.ajax({
            url :  DOMAIN + "/includes/process.php",
            method : "POST",
            data : {getCategory:1},
            success : function(data){ 
            var root = "<option value='0'>Root</option>";
            var choose = "<option value=''>Choose Category</option>";
            $("#parent_cat").html(root+data); 
            $("#select_cat").html(choose+data);  
            }
        })
    }

        //fetch brand
    fetch_brand();
    function fetch_brand(){
            $.ajax({
            url :  DOMAIN + "/includes/process.php",
            method : "POST",
            data : {getBrand:1},
            success : function(data){ 
            var choose = "<option value=''>Choose Brand</option>";
            $("#select_brand").html(choose+data);  
            }
        })
    }

    //Add Category
    $("#category_form").on("submit",function(){
        if ($("#category_name").val()==""){
            $("#category_name").addClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Please Enter Category Name.</span>");
        }else{
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                data : $("#category_form").serialize(),
                success : function(data){
                    if (data == "CATEGORY_ADDED"){
                        $("#category_name").removeClass("border-danger");
                        $("#cat_error").html("<span class='text-success'>New Category Added Successfully.</span>");
                        $("#category_name").val("");
                        fetch_category();
                    }else{
                        alert(data);
                    }
                }
            })
        }
    })
    //Add Brand
    $("#brand_form").on("submit",function(){
        if ($("#brand_name").val()==""){
            $("#brand_name").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name!</span>");
        }else{
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                data : $("#brand_form").serialize(),
                success : function(data){
                    if (data == "BRAND_ADDED"){
                        $("#brand_name").removeClass("border-danger");
                        $("#brand_error").html("<span class ='text-success'>New Brand  Added Successfully.</span>");
                        $("#brand_name").val("");
                        fetch_brand();
                    }else{
                        alert(data);
                    }
                }
            })
        }
    })
    
    //Add Product
    $("#product_form").on("submit",function(){
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            data : $("#product_form").serialize(),
            success : function(data){
                if (data == "NEW_PRODUCT_ADDED"){
                   alert("New Product Added Successfully...!");
                   $("#product_name").val("");
                   $("#select_cat").val("");
                   $("#select_brand").val("");
                   $("#product_price").val("");
                   $("#product_qty").val("");

                }else{
                    alert(data);
                }
            }
        })

    })

    //edit profile
    $('#edit_profile_form').on('submit',function(event){
        event.preventDefault();
        if ($('#password1').val() !='') {
            //Comparing password if they match
            if ($('#password1').val() != $('#password2').val()) {
                $('#error_password').html('<label class ="text-danger">Password Not Match</label>');
            }else{
                $('#error_password').html('');
            }
        }
        //Disabling Submit Button
        $('#edit_profile').attr('disabled','disabled');
         
        //stores for data in variable form_data
        var form_data = $(this).serialize();
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            data : form_data,
            success:function (data) {
                $('#edit_profile').attr('disabled', false);
                $('#password1').val('');
                $('#password2').val('');
                $('#message').html(data);
            }
        })
    })

})




