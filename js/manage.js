$(document).ready(function(){

    var DOMAIN = "http://localhost:8080/ivm/public_html";

    //-----------------------CATEGORY----------------------
        //Manage Category
        manageCategory(1);
        function manageCategory(pn){
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                data : {manageCategory:1,pageno:pn},
                success : function(data){
                    $("#get_category").html(data);
                }
            })

        }

        $("body").delegate(".page-link","click",function(){
            var pn = $(this).attr("pn");
            manageCategory(pn);
        })

        //Deleting category
        $("body").delegate(".del_cat","click",function(){
            var did = $(this).attr("did");
            if (confirm("Are you sure? You want? You want to delete...!")){
                $.ajax({
                    url : DOMAIN+"/includes/process.php",
                    method : "POST",
                    data : {deleteCategory:1,id:did},
                    success : function(data){
                        data = data.toString().trim();
                        // console.log(data);
                        if(data == "DEPENDENT_CATEGORY"){
                            alert("Sorry! this category is dependent on other sub-category");
                        }else if (data == "CATEGORY_DELETED") {
                            alert("Category Deleted Successfully..!");
                        }else if (data == "DELETED") {
                            alert("Deleted Successfully");
                        }else{
                            alert(data);
                        }
                    }
                })
            }
        })

        
        //fetch category 
    fetch_category();
    function fetch_category(){
        $.ajax({
            url :  DOMAIN + "/includes/process.php",
            method : "POST",
            data : {getCategory:1},
            success : function(data){ 
            var root = "<option value='0'>Root</option>";
            var choose = "<option value='0'>Choose</option>";
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


    //Update Category
    $("body").delegate(".edit_cat","click",function(){

    var eid = $(this).attr("eid");
        // var emodal = document.querySelector('#form_category');
        // emodal.style.display = "block";

            $.ajax({
                url : DOMAIN+"/includes/process.php",
                    method : "POST",
                    dataType: "json",
                    data : {updateCategory:1,id:eid},
                    success : function(data){
                        console.log(data);
                        $("#cid").val(data["cid"]);
                        $("#update_category").val(data["category_name"]);
                        $("#parent_cat").val(data["parent_cat"]);
                    }
            })  
        })
    
    $("#update_category_form").on("submit",function(){
        if ($("#update_category").val()==""){
            $("#update_category").addClass("border-danger");
            $("#cat_error").html("<span class='text-danger'>Please Enter Category Name.</span>");
        }else{
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                data : $("#update_category_form").serialize(),
                success : function(data){
                    alert(data);
                    window.location.href ="";
                }
            })
        }
    })


//--------------------BRAND--------------------------------
    //Managing Brand
    manageBrand(1);
    function manageBrand(pn){
        $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data : {manageBrand:1,pageno:pn},
        success : function(data){
            $("#get_brand").html(data);
            }
        })
    
    }
    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageBrand(pn);
    })

    $("body").delegate(".del_brand","click",function(){
        var did = $(this).attr("did");
        if (confirm("Are you sure? You want to delete brand...!")){
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                data : {deleteBrand:1,id:did},
                success : function(data){
                    // data = data.toString().trim();
                    // console.log(data);
                    if(data == "DELETED"){
                        alert("Brand is deleted");
                        manageBrand(1);
                    } else{
                        alert(data);
                    }
                        
                }
            })
        }
    })


    //Update Brand
    $("body").delegate(".edit_brand","click",function(){
        var eid = $(this).attr("eid");
        // var emodal = document.querySelector('#form_category');
        // emodal.style.display = "block";

            $.ajax({
                url : DOMAIN+"/includes/process.php",
                    method : "POST",
                    dataType: "json",
                    data : {updateBrand:1,id:eid},
                    success : function(data){
                        console.log(data);
                        $("#bid").val(data["bid"]);
                        $("#update_brand").val(data["brand_name"]);
                    }
            })  
        })



    $("#update_brand_form").on("submit",function(){
        if ($("#update_brand").val()==""){
            $("#update_brand").addClass("border-danger");
            $("#brand_error").html("<span class='text-danger'>Please Enter Brand Name.</span>");
        }else{
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                data : $("#update_brand_form").serialize(),
                success : function(data){
                    alert(data);
                    window.location.href ="";
                }
            })
        }
    })

    //--------------------Product--------------------------------
    //Managing Brand
    manageProduct(1);
    function manageProduct(pn){
        $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data : {manageProduct:1,pageno:pn},
        success : function(data){
            $("#get_product").html(data);
            }
        })
    
    }
    $("body").delegate(".page-link","click",function(){
        var pn = $(this).attr("pn");
        manageProduct(pn);
    })

    $("body").delegate(".del_product","click",function(){
        var did = $(this).attr("did");
        if (confirm("Are you sure? You want to delete Product...!")){
            $.ajax({
                url : DOMAIN+"/includes/process.php",
                method : "POST",
                data : {deleteProduct:1,id:did},
                success : function(data){
                    // data = data.toString().trim();
                    // console.log(data);
                    if(data == "DELETED"){
                        alert("Product is deleted");
                        manageProduct(1);
                        window.location.href = "";
                    } else{
                        alert(data);
                    }
                        
                }
            })
        }
    })


    ///-------------------------------------

    $('body').on('click', '.p_action', function(){
        
        var pid = $(this).attr('data-product_id');
        // alert(product_id);
        var product_status = $(this).attr('data-product_status');
        var p_action = 'change_status';
        $('#message').html('');
        if(confirm("Are you sure you want to change the status of this user?")){
            $.ajax({
                url: DOMAIN+"/includes/process.php",
                method: "POST",
                data:{pid:pid, product_status:product_status, p_action:p_action},
                success:function (data) {
                    // console.log(pid);
                    // return;
                    if (data != '') {
                        manageProduct(1);
                        // alert(pid);
                        
                        $('#message').html(data);
                    }
                }
            })
        }else{
            return false;
        }
    })

        //Update Product
        $("body").delegate(".edit_product","click",function(){
            var eid = $(this).attr("eid");
    
                $.ajax({
                    url : DOMAIN+"/includes/process.php",
                        method : "POST",
                        dataType: "json",
                        data : {updateProduct:1,id:eid},
                        success : function(data){
                            console.log(data); 
                            $("#pid").val(data["pid"]);
                            $("#update_product").val(data["product_name"]);
                            $("#select_cat").val(data["cid"]);
                            $("#select_brand").val(data["bid"]);
                            $("#product_price").val(data["product_price"]);
                            $("#product_qty").val(data["product_stock"]);
                        }
                })  
            })


    //Add Product
    $("#update_product_form").on("submit",function(){
        $.ajax({
            url : DOMAIN+"/includes/process.php",
            method : "POST",
            data : $("#update_product_form").serialize(),
            success : function(data){ 
                if (data == "Update Successful") { 
                    alert ("Product Updated Successfully..!");
                    window.location.href = "";
                }else{
                    alert(data);
                }
                    
            }
        })

    })


       
           //------------------------Listing Users & Adding Users-----------------------------

        load_user_data();
        function load_user_data(){
            var action = 'fetch';
            $.ajax({
                url : DOMAIN+"/includes/adminaction.php",
                method : "POST",
                data : {action:action},
                success : function(data){
                    $("#user_data").html(data);
                    }
                })
        }

    //Activating and Activating User

    $('body').on('click', '.action', function(){
        
        var user_id = $(this).attr('data-user_id');
        // alert("user_id");
        var user_status = $(this).data('user_status');
        var action = 'change_status';
        $('#message').html('');
        if(confirm("Are you sure you want to change the status of this user?")){
            $.ajax({
                url: DOMAIN+"/includes/adminaction.php",
                method: "POST",
                data:{id:user_id, user_status:user_status, action:action},
                success:function (data) {
                    // console.log(data);
                    // return;
                    if (data != '') {
                        load_user_data();
                        // alert(user_id);
                        
                        $('#message').html(data);
                    }
                }
            })
        }else{
            return false;
        }
    })
    //On click event to delete user from database
    $('body').on('click', '.delete_user', function(e){
        e.preventDefault();
        
        var user_id = $(this).attr('data-user_id');
        // alert(user_id);

        $('#message').html('');
        if(confirm("Are you sure you want to delete this user?")){
            $.ajax({
                url: DOMAIN+"/includes/adminaction.php",
                method: "POST",
                data:{id:user_id,delete_user: 1},
                success:function (data) {
                    console.log(data);
                    // return;
                    if (data ) {
                        // alert('deleted');
                        window.location.assign('manage_user.php')
                    }else{
                        alert('error deleting user');
                    }
                },
                error: function(){
                    alert('error');
                }
            })
        }else{
            return false;
        }
    })


//------------------------Listing Users & Adding Users Ends-----------------------------

})
    
 