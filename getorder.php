
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once './users/init.php';
//require_once './users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])) {die();}







$servername = "localhost";
$username = "delivery";
$password = "Garrett10!";
$dbname = "delivery";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$cm = $_POST['customer'];
$Toaddress = $_POST['Dropoff'];
$from = $_POST['Pickup'];
$sql = "INSERT INTO Deliverys(customer, Dropoff, Pickup)
VALUES ('$cm', '$Toaddress', '$from')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

}

if(hasPerm([3],$user->data()->id)) {
//header("Refresh:10;");

$sql = "SELECT * FROM delivery.Deliverys WHERE IF( (SELECT COUNT(*) FROM delivery.Deliverys WHERE driver = {$user->data()->id} AND status != '1') = 1, driver = {$user->data()->id} AND status = 0, driver = '') LIMIT 1;";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) { ?>
        <div style="text-align:left;color:#000000;" class="card">
        <h5 Class="card-header"> Order Details</h5> 
        <div class="card-body">
          <h5 class="card-title">;
              id: <?=$row["id"]?> <br> 
            Name: <?=$row["customer"]?><br>
            Colect from <?=$row["Pickup"]?><br> 
            Deliver to <?=$row['Dropoff']?><br>
            Delivery Cost: £5<br>
          </div>
        </div>
          <button name="claim" id="<?=$row["id"]?>">Claim Order</button>
          <button name="markDelivered" id="<?=$row['id']?>">Delivered</button>
<?php
  }
} else {
  echo "No Active Orders";
}
}

elseif (hasPerm([1],$user->data()->id)){ ?>
 Under Dev

<form action="" method="POST">
<div class="form-group">
<label for="customer">Customer</label>
<input type="text" class="form-control" name="customer" id="customer" value="">
</div>
<div class="form-group">
<label for="Pickup">Pickup</label>
<input type="text" class="form-control" name="Pickup" id="Pickup" value="">
</div>
<div class="form-group">
<label for="Dropoff">Dropoff</label>
<input type="text" class="form-control" name="Dropoff" id="Dropoff" value="">
</div>
<div class="form-group">
<label for="collecttime">Collect time</label><input type="datetime-local" class="form-control" name="collecttime" id="collecttime" value="">
</div>
<button type="submit">Place Order</button>
</form>

<?php }

elseif (hasPerm([4],$user->data()->id)) {
echo 'shop under development';
}
else {
echo 'please relogin';
}
$conn->close();
?>

<script>
$(document).ready(function(){
  $("button[name='markDelivered']").css("display:none");
  $("button[name='claim']").click(function(){
    $(this).css("display:none");
    $.post("./claimorder.php",
    {
      function:"claim",
      id: this.id,
      user:  "<?=$user->data()->id?>"
    },
    function(data,status){
       if(status == "sucsess"){
	$("button[name='markDelivered']").css("display:block");
       }else{
	$("button[name='claim']").css("display:block");
       }
    });
  });
  $("button[name='markDelivered']").click(function(){

  });
});
</script>  


