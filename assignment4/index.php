<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Employees Details</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="employees" class="table table-dark table-hover">
                      <thead>
                      <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Delete</th>
                        <th>Update</th>
                      </tr>
                      </thead>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>';

  include('master.php');
?>
<!-- page script -->
<script>

  $(document).ready(function(){

    $.ajax({
        type: "GET",
        url: "http://localhost:80/pRESTige-master/api/employee",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
                "<td>"+data[user].Id+"</td>"+
                "<td>"+data[user].first_name+"</td>"+
                "<td>"+data[user].last_name+"</td>"+
                "<td>"+data[user].email+"</td>"+
                "<td> <a onClick=Remove('"+data[user].Id+"')> Delete </a></td>"+
                "<td><a href='update.php?id="+data[user].Id+"'> Update </a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#employees"));
        }
    });
  });

  function Remove(Id){

    $.ajax(
        {
            type: "POST",
            url: 'http://localhost:80/pRESTige-master/api/employee',
            dataType: 'json',
            data: {
                id: Id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Removed Doctor!");
                    window.location.href = 'index.php';
                }
                else {
                    alert(result['message']);
                }
            }
        });
  };

</script>