<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Update Employee</h3>
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
                        <input type="button" class="btn btn-primary" onClick="UpdateEmployee()" value="Update"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
              
  include('master.php');
?>
<script>
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "http://localhost:80/pRESTige-master/api/employee?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#firstname').val(data['first_name']);
                $('#lastname').val(data['last_name']);
                $('#email').val(data['email']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function UpdateEmployee(){
        $.ajax(
        {   
            type: "POST",
            url: 'http://localhost:80/pRESTige-master/api/employee',
            dataType: 'json',
            data: {
                Id: <?php echo $_GET['id']; ?>,
                first_name: $("#firstname").val(),
                last_name: $("#lastname").val(),
                email: $("#email").val(),        
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Updated Employee!");
                    window.location.href = '/phpmysql/assignment4';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>
</body>
</html>