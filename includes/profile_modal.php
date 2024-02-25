<!-- Transaction History -->
<style>
    .status-green {
        display: inline-block;
        padding: 5px 10px;
        background-color: green;
        color: white;
        border-radius: 5px;
        font-weight: bold;
    }
</style>

<div class="modal fade" id="transaction">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Transaction Full Details</b></h4>
            </div>
            <div class="modal-body">
            <p style="font-weight: bold; font-size: 16px;"> Status: </p>
            
            <span id="sales_status" style="color: green; font-weight: bold; font-size: 16px;"></span>
            
            <hr>
            <p style="font-weight: bold; font-size: 16px;"> Delivery Address:</p>
              <p> <span id="sales_recipient"></span> </p>
              <p> <span id="sales_contact_info"></span> </p>
              <p> <span id="sales_address"></span> </p>
              <p style="font-weight: bold; font-size: 14px;"> <span id="pay_method"></span> <p>
          <hr>
          <p style="font-weight: bold; font-size: 16px;"> Date: </p>
          <p> <span id="date"> </span> </p>
          <hr>
          <p style="font-weight: bold; font-size: 16px;"> Transaction#: </p> 
          <span id="transid"></span>

          <hr>

              <table class="table table-bordered">
                <thead>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
              
                </thead>
                <tbody id="detail">
                  <tr>
                    <td colspan="3" align="right"><b>Total</b></td>
                    <td><span id="total"></span></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>



<!-- Edit Profile -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Update Account</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="profile_edit.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact" class="col-sm-3 control-label">Contact Info</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $user['contact_info']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" id="address" name="address"><?php echo $user['address']; ?></textarea>
                    </div>
                </div>

                <hr>

                    <div style="margin-left: 20px;"> <h3> Delivery Addresses: </h3>
                    <p> You can add two additional delivery addresses. </p> </div>
                <h4 style="margin-left: 20px;"> Address #1 </h4>

                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Recipient:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="buyer2" name="buyer2"><?php echo $user['buyer2']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Contact Info:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="contact_info2" name="contact_info2"><?php echo $user['contact_info2']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="address2" name="address2"><?php echo $user['address2']; ?></textarea>
                    </div>
                </div>

              <h4 style="margin-left: 20px;"> Address #2 </h4>

              <div class="form-group">
                  <label for="address" class="col-sm-3 control-label">Recipient:</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" id="buyer3" name="buyer3"><?php echo $user['buyer3']; ?></textarea>
                  </div>
              </div>
              <div class="form-group">
                  <label for="address" class="col-sm-3 control-label">Contact Info:</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" id="contact_info3" name="contact_info3"><?php echo $user['contact_info3']; ?></textarea>
                  </div>
              </div>
              <div class="form-group">
                  <label for="address" class="col-sm-3 control-label">Address:</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" id="address3" name="address3"><?php echo $user['address3']; ?></textarea>
                  </div>
              </div>

              

                <hr>



                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo">
                    </div>
                </div>
                <hr>
                
                <div class="form-group">
                    <label for="curr_password" class="col-sm-3 control-label">Current Password</label>

                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="input current password to save changes" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>