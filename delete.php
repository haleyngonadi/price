<?php

include_once('connection.php');



$sql = "DELETE FROM pricelist WHERE item_code='" . $_POST["item_code"] . "'";

if ($conn->query($sql) === TRUE) {
    echo "deleted";
} else {
    echo "Error deleting record: " . $conn->error;
}
