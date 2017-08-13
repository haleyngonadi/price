<?php

include_once('connection.php');


	if (isset($_POST["item_code"])){
	$code = $_POST['item_code'];
	}

	if (isset($_POST["item_image"])){
	$image = $_POST['item_image'];
	}

	


	if (isset($_POST["item_type"])){
	$type = $_POST['item_type'];}

	


	if (isset($_POST["item_description"])){
	$desc = $_POST['item_description'];}


	if (isset($_POST["item_more"])){
	$more = $_POST['item_more'];}


	if (isset($_POST["item_quantity"])){
	$qty = $_POST['item_quantity'];}


	if (isset($_POST["item_price"])){
	$price = $_POST['item_price'];}


	if (isset($_POST["item_remarks"])){
	$remarks = $_POST['item_remarks'];}





$sql = "INSERT INTO pricelist (item_code, item_price, item_image, item_type, item_description,item_more, item_quantity, item_remarks)
VALUES ('$code', '$price', '$image','$type','$desc','$more','$qty','$remarks')";

	$query = mysqli_query($conn, $sql);
		if($query){
			echo "good";
		}else {
			echo "bad";
		}


