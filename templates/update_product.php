

<!-- Modal -->
<div class="modal fade" id="form_products" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="update_product_form" onsubmit="return false"> 
            <div class="form-row">
              <div class="form-group col-md-6">
               <input type="hidden" name="pid" id ="pid" value=""/>  
                <label>Date</label>
                <input type="text" class="form-control" id="added_date" name="added_date" value="<?php echo Date('Y-m-d h:i:sa');?>" readonly>
              </div>
              <div class="form-group col-md-6">
                <label>Product Name</label>
                <input type="text" class="form-control" id="update_product" name="update_product" placeholder="Enter Product Name" required>
              </div>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select class="form-control" id="select_cat" name="select_cat" required>

              </select>
              <small id="cat_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Brand</label>
              <select class="form-control" id="select_brand" name="select_brand" required >

              </select>
              <small id="brand_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Product Price</label>
              <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Price of Product" required>
            </div>
            <div class="form-group">
              <label>Quantity</label>
              <input type="text" class="form-control" id="product_qty" name="product_qty" placeholder="Enter Quantity" required>
            
            </div>
            <button type="submit" class="btn btn-success">Update Product</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>