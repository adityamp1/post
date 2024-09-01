<?php
$servername = "127.0.0.1";
$username = "adityap";
$password = "aditya";
$db = "postoffice";
 
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);
 
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
 
if (isset($_POST['action'])) {
    $action = $_POST['action'];
 
    switch ($action) {
        case 'fetch_dist':
            fetchdist();
            break;
        case 'fetch_taluk':
            fetchtaluk();
            break;
        case 'fetch_area':
            fetcharea();
            break;
        case 'fetch_pincode':
            fetchpincode();
            break;
        default:
            break;
    }
}
 
function fetchdist(){
    global $conn;
    $state = $_POST['state'];
 
    $sql = "select distinct county from india where state='" . $state . "' order by county";
    $result = mysqli_query($conn, $sql);
 
    $output = '<option>Select District</option>';
 
    while ($data = mysqli_fetch_array($result)) {
        $output .= "<option>" . $data['county'] . "</option>";
    }
 
    echo $output;
}
 
function fetchtaluk(){
    global $conn;
    $state = $_POST['state'];
    $dist = $_POST['dist'];
 
    $sql = "select distinct community from india where state='" . $state . "' and county='" . $dist . "' order by community";
    $result = mysqli_query($conn, $sql);
 
    $output = '<option>Select taluk</option>';
 
    while ($data = mysqli_fetch_array($result)) {
        $output .= "<option>" . $data['community'] . "</option>";
    }
 
    echo $output;
}
 
 
 
function fetcharea(){
    global $conn;
$state = $_POST['state'];
$dist = $_POST['dist'];
$taluk = $_POST['taluk'];
 
 
 
 
 
$sql = "select distinct city from india where state='" . $state . "' and county='" . $dist . "' and community='" . $taluk . "' order by city";
 
 
$result = mysqli_query($conn,$sql);
 
$output ='<option>Select area</option>';
 
while($data = mysqli_fetch_array($result))
{
    $output .="<option>".$data['city']."</option>";
   
}
 
echo $output;
 
}
 
 
 
function fetchpincode(){
    global $conn;
$state = $_POST['state'];
$dist = $_POST['dist'];
$taluk = $_POST['taluk'];
$area = $_POST['area'];
 
 
 
 
 
$sql = "select distinct postal_code from india where state='" . $state . "' and county='" . $dist . "' and community='" . $taluk . "' and city='" . $area . "'";
 
 
$result = mysqli_query($conn,$sql);
/*
$output ='<option>Select area</option>';
 
while($data = mysqli_fetch_array($result))
{
    $output .="<option>".$data['city']."</option>";
   
}*/
$row = $result->fetch_assoc();
 
echo $row['postal_code'];
 
}
?>
