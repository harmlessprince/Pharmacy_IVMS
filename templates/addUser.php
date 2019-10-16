
<!-- Modal -->
<div class="modal fade" id="add_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      <form method="post" action="">
      <?php  include("errors.php"); ?>
        		<div class="modal-content">
        			<div class="modal-body">
                    <div class="form-group">
                  <label>Enter User Name</label>
                  <input type="text" name="user_name" id="user_name" min="6" class="form-control" required />
                    </div>
						<div class="form-group">
							<label>Enter User Email</label>
							<input type="email" name="user_email" id="user_email"  class="form-control" required />
                            
						</div>
						<div class="form-group">
							<label>Enter User Password</label>
							<input type="password" name="user_password1" id="user_password1" minlength="" class="form-control" required />
                            <small id="p1_error" class="form-text text-muted"></small>
						</div>
                        <div class="form-group">
							<label>Re-enter User Password</label>
							<input type="password" name="user_password2" id="user_password2"  class="form-control" required />
                            <small id="p2_error" class="form-text text-muted"></small>
						</div>
                        <div class="form-group">
                            <label for="usertype">User-type</label>
                            <select name="usertype" class="form-control">
                                <option value="">Choose user type</option>
                                <option value="admin">Admin</option>
                                <option value="user">Other User</option>
                            </select>
                            <small id="type_error" class="form-text text-muted"></small>
                        </div>
        			</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name = "add_user" class="btn btn-primary">Add User</button>
                    </div>
        </form>
      </div>

    </div>
  </div>
</div>

     