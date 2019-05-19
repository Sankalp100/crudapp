<?php
$request_method = $_SERVER['REQUEST_METHOD'];
$response = array();


switch($request_method) {

    case "GET":
        response(doGet());
    break;

    case "POST":
        response(doPost());
    break;

    case "DELETE":
        response(doDelete());
    break;

    case "PUT":
        response(doPut());
    break;
}

function doGet() {

    if(@$_GET['id']) {
        @$id = $_GET['id'];
        $where = "WHERE `id`=" .$id;
    } else {
        $id = 0;
        $where = "";
    }

    $dbconnect = mysqli_connect("localhost","root","","phpapp");
    $query = mysqli_query($dbconnect, "SELECT * FROM `users`".$where);

    while($data = mysqli_fetch_assoc($query)) {
        $response[] = array("id" => $data['id'], "first_name" => $data['first_name'],"last_name" => $data['last_name'] , "email" => $data['email']);

    }
    
    //echo json_encode($data);
    return $response;
    
} 

function doPost() {

    if(@$_POST) {
        
        $dbconnect = mysqli_connect("localhost","root","","phpapp");
        $query = mysqli_query($dbconnect, "INSERT INTO `users` (`first_name`,`last_name`,`email`) VALUES('".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['email']."')");
        if ($query == true) {
            $response = array("message"=>"Successfully inserted ");
        } else {
            $response = array("message"=>"Failed");
        }    

    }   
    
    return $response;
    
}

function doDelete() {

    if(@$_GET['id']) {
        
        $dbconnect = mysqli_connect("localhost","root","","phpapp");
        $query = mysqli_query($dbconnect, "DELETE FROM `users` WHERE `id` = '".$_GET['id']."' ");
        if ($query == true) {
            $response = array("message"=>"Successfully deleted");
        } else {
            $response = array("message"=>"Failed");
        }    

    }   
    
    return $response;
    
}

function doPut() {

    parse_str(file_get_contents('php://input'), $_PUT);

    if(@$_PUT) {
        

        $dbconnect = mysqli_connect("localhost","root","","phpapp");
        $query = mysqli_query($dbconnect, "UPDATE `users` SET 

                                `first_name`  = '".$_PUT['first_name']."',
                                `last_name`  = '".$_PUT['last_name']."',
                                `email`  = '".$_PUT['email']."'        

                        
                                WHERE `id` = '".$_GET['id']."'
                                ");
        if ($query == true) {
            $response = array("message"=>"success updated");
        } else {
            $response = array("message"=>"failed");
        }    

    }   
    
    return $response;
}



//output
function response($response) {
 
    echo json_encode(array("status"=> "200","data"=> $response));

} 
    
?>