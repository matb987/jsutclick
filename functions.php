<?php

function placeorder() {
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

}



?>