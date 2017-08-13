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



	$sql = "UPDATE pricelist SET  item_price = '$price', item_image = '$image', item_type = '$type', item_description = '$desc', item_more = '$more', item_quantity = '$qty', item_remarks = '$remarks' WHERE item_code='$code'";

	$query = mysqli_query($conn, $sql);
		if($query){
			echo "good";
		}else {
			echo "bad";
		}