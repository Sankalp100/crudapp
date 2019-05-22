<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Add Employee</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="firstname">First Name</label>
                          <input type="text" class="form-control" id="firstname" placeholder="Enter you first name">
                        </div>
                        <div class="form-group">
                          <label for="lastname">Last Name</label>
                          <input type="text" class="form-control" id="lastname" placeholder="Enter your last name">
                        </div>
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" placeholder="Enter your email">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddEmployee()" value="Submit"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
  include('master.php');
?>
<script>
  function AddEmployee(){
        $.ajax(
        {
            type: "POST",
            url: 'http://localhost:80/pRESTige-master/api/employee',
            dataType: 'json',
            data: {
                first_name: $("#firstname").val(),
                last_name: $("#lastname").val(),
                email: $("#email").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Doctor!");
                    window.location.href = 'assignment4/index.php';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>