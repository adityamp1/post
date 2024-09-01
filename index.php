<?php
$servername = "127.0.0.1";
$username = "adityap";
$password = "aditya";
$db="postoffice";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 20px;
        background-color: #f5f5f5; /* Light grey background */
        color: #333; /* Dark text color */
    }

    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff; /* White form background */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        border-radius: 8px; /* Rounded corners */
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold; /* Bold labels */
    }

    select, input {
        width: 100%;
        padding: 10px; /* Increased padding for inputs */
        margin-bottom: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    select {
        background-color: #f9f9f9; /* Slightly darker background for select elements */
    }

    input {
        background-color: #f9f9f9;
    }

    input[type="submit"] {
        background-color: #4CAF50; /* Green submit button */
        color: white; /* White text on submit button */
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease; /* Smooth hover effect */
    }

    input[type="submit"]:hover {
        background-color: #45a049; /* Darker green on hover */
    }
</style>
</head>
<body>
<form id="locationForm">
    <label for="state">State:</label>
    <select id="state">
        <option>Select State</option>

        <?php
        $sql="select distinct state from india where state != 40 and state != 34 and state != 19 and state != 37 and state != 07 order by state";
        $result=mysqli_query($conn,$sql);

        while($data=mysqli_fetch_array($result))
        {?>
            <option value="<?php echo $data['state']?>"><?php echo $data['state'];?></option>
        <?php } ?>
    </select>

    <label for="dist">District:</label>
    <select id="dist">
        <option>Select District</option>
    </select>

    <label for="talluk">Talluk:</label>
    <select id="taluk">
        <option>Select taluk</option>
    </select>

    <label for="area">Area:</label>
    <select id="area">
        <option>Select area</option>
    </select>

    <input type="submit" value="Submit">

    <label for="pincode">Pincode:</label>
    <input type="text" id="pincode" name="pincode" readonly>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
var hi;
$("#state").change(function() {
    console.log("done");
    $state = $("#state").val();

    $.ajax({
        url: 'data.php',
        method: 'POST',
        data: {'state': $state, 'action': "fetch_dist"},
        success: function(response) {
            $("#dist").html(response);
            console.log("done2");
        }
    });
});

$("#dist").change(function() {
    console.log("done2");
    $state = $("#state").val();
    $dist = $("#dist").val();

    $.ajax({
        url: 'data.php',
        method: 'POST',
        data: {'state': $state, 'dist': $dist, 'action': "fetch_taluk"},
        success: function(response) {
            $("#taluk").html(response);
        }
    });
    console.log("done3");
});

$("#taluk").change(function() {
    console.log("done5");
    $state = $("#state").val();
    $dist = $("#dist").val();
    $taluk = $("#taluk").val();

    $.ajax({
        url: 'data.php',
        method: 'POST',
        data: {'state': $state, 'dist': $dist, 'taluk': $taluk, 'action': "fetch_area"},
        success: function(response) {
            $("#area").html(response);
        }
    });
    console.log("done6");
});

$('#locationForm').submit(function (e) {
    e.preventDefault();

    $state = $("#state").val();
    $dist = $("#dist").val();
    $taluk = $("#taluk").val();
    $area = $("#area").val();

    $.ajax({
        url: 'data.php',
        method: 'POST',
        data: {'state': $state, 'dist': $dist, 'taluk': $taluk, 'area': $area, action: "fetch_pincode"},
        success: my_func,
    });
});

function my_func(response){
    hi = response;
    $("#locationForm").html(hi);
}
console.log(hi);
</script>

</body>
</html>
