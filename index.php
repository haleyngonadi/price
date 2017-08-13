<?php

include_once('connection.php');

/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/croppie.css" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>

<body>

<header style="background-color: #022638; padding: 10px 0;border-bottom: 7px solid #011d2b;">
                <div class="logo" style="margin: 0 auto; width: 120px;">
                	 <img src="logo.png" style="max-height: 120px;">

                </div>
</header>

<div class="top">
<button class="addnew">Add Item</button>
<button class="generate">Generate PDF</button>
<button class="editing">Turn Editing On</button>

</div>


<div id="page" class="hfeed site">


<?php

// $csv = array_map('str_getcsv', file('price.csv'));

// foreach ($csv as &$value) {

// $sql = "INSERT INTO pricelist (item_code, item_price, item_type, item_description,item_more, item_quantity, item_remarks)
// VALUES ('$value[1]', '$value[6]', '$value[3]','$value[2]','$value[4]','$value[5]','$value[7]')";

//  // $query = mysqli_query($conn, $sql);


// }


?>



<div class="row additem">

<h3> Add New Item </h3>

<div class="col-md-2 col-xs-12">
	<label for="code">Item Code<span class="red">*</span></label><input type="text" name="code" value="">
</div>

<div class="col-md-2 col-xs-12">
	<label for="more"> Unit Price</label><input type="text" name="price" class="validate" value="">
</div>

<div class="col-md-2 col-xs-12"> 
	<label for="quantity"> Quantity</label><input type="number" name="quantity" value="" min="1" >
</div>

<div class="col-md-2 col-xs-12">
	<label for="more"> Watts</label><input type="text" name="more" value="">
</div>

<div class="col-md-2 col-xs-12">
	<label for="remarks"> Remarks</label><input type="text" name="remarks" value="">
</div>


<div class="col-md-2 col-xs-12">
	<label for="tag"> Type	</label>
	<select name="tag">
	
	<option selected>Table Lamp</option>
	<?php $arr = ['Pendant', 'Chandelier', 'Wall Bracket', 'Standing Lamp', 'Dinning Lamp', 'Ceiling Lamp'];
	foreach ($arr as $key => $value) {
		$out = '<option>';
		$out .= $value;
		$out .= '</option>';
		echo $out;
	}

	?>

	</select>

</div>


<div class="col-md-12 col-xs-12" style="text-align: left">
	<label for="description">Item Description</label><textarea name="description" rows="2" cols="30"></textarea> 


</div>
<div class="col-md-12 col-xs-12">
	<input type="file" id="upload">


					<div id="upload-demo" class="upload-demo"></div>
					



					<span class="loading">Uploading...</span>

				


</div>



<button class="add col-md-2">Save</button>

<p class="col-md-12"> Fields marked <span class="red">*</span> are required. </p>



<div class="bg-success text-white col-md-12" style="display: none"></div>
<div class="bg-warning text-white col-md-12" style="display: none"></div>



</div>




<?php 

$sql = "SELECT item_code, item_image, item_type, item_description,item_more, item_quantity, item_price, item_remarks  FROM pricelist ORDER BY item_created ASC";
$result = $conn->query($sql);


if ($result->num_rows > 0) { ?>
   
<table style="font-family: Lato, sans-serif; border-collapse: collapse; width: 100%;">
 	<thead>
   <div style="font-weight:bold;border: 0 !important;background-color: #021f2d;padding:8px 0; text-align: center; text-transform: uppercase;color:#fff;">Price List For Light Fittings</div>

  <tr>
    <th>Photo</th>
    <th>Item Code</th>
    <th>Description (LED)</th>
    <th>Light Type</th>
    <th>Watts</th>
    <th>Qty</th>
    <th>Unit Price</th>
    <th>Remarks</th>
    <th class="edit" style="display: none">Actions</th>

  </tr>
  </thead>

    <?php while($row = $result->fetch_assoc()) { ?>

    <tr style="min-height: 100px;" data-item="<?php echo $row["item_code"]?>">
    <?php if ($row["item_image"]) :?>
    <td style="border: 1px solid #f3f3f3; text-align: center; padding: 8px; font-weight: 300;">
    <div class="small" style="height: 56px; width: 75px; margin: 0 auto;"><img src="<?php echo $row["item_image"]?>" style="border-radius: 0%;"></div>
    </td>
	<?php else:?>
    <td style="border: 1px solid #f3f3f3; text-align: center; padding: 8px; font-weight: 300;"></td>

	<?php endif;?>

	<td style="border: 1px solid #f3f3f3; text-align: center; padding: 8px; font-weight: 300;"><?php echo $row["item_code"]?></td>
	<td style="border: 1px solid #f3f3f3; text-align: center; padding: 8px; font-weight: 300;"><?php echo $row["item_description"]?></td>

	<td style="border: 1px solid #f3f3f3; text-align: center; padding: 8px; font-weight: 300;"><?php echo $row["item_type"]?></td>
	<td style="border: 1px solid #f3f3f3; text-align: center; padding: 8px; font-weight: 300;"><?php echo $row["item_more"]?></td>
	<td style="border: 1px solid #f3f3f3; text-align: center; padding: 8px; font-weight: 300;"><?php echo $row["item_quantity"]?></td>
	<td style="border: 1px solid #f3f3f3; text-align: center; padding: 8px; font-weight: 300;"><?php echo $row["item_price"]?></td>
	<td style="border: 1px solid #f3f3f3; text-align: center; padding: 8px; font-weight: 300;"><?php echo $row["item_remarks"]?></td>
	<td class="edit-table" style="display: none">
  <button title="Edit Item" data-code="<?php echo $row["item_code"]?>" class="edit-button change" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" aria-hidden="true"></i></button>
  <button title="Delete Item" data-code="<?php echo $row["item_code"]?>" class="edit-button delete" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
  	
  </tr>

   <? }
} else {
    echo "<div class='nothing'>It looks like you have not added anything items yet. Use the 'Add Item' button above to get started.</div>";
}
$conn->close();

?>


</table>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">


<div class="col-md-4 col-xs-12">
  <label for="code">Item Code</label><input type="text" name="code" value="" id="code" disabled>
</div>

<div class="col-md-4 col-xs-12">
  <label for="more"> Unit Price</label><input type="text" name="price" id="price" value="">
</div>

<div class="col-md-4 col-xs-12"> 
  <label for="quantity"> Quantity</label><input type="number" name="quantity" id="qty" value="" min="1" >
</div>

<div class="col-md-4 col-xs-12">
  <label for="more"> Watts</label><input type="text" name="more" id="watts" value="">
</div>

<div class="col-md-4 col-xs-12">
  <label for="remarks"> Remarks</label><input type="text" name="remarks" id="remarks" value="">
</div>


<div class="col-md-4 col-xs-12">
  <label for="tag"> Type  </label>
  <select name="tag" id="tag">
  
  <option selected>Table Lamp</option>
  <?php $arr = ['Pendant', 'Chandelier', 'Ceiling Lamp'];
  foreach ($arr as $key => $value) {
    $out = '<option>';
    $out .= $value;
    $out .= '</option>';
    echo $out;
  }

  ?>

  </select>

</div>


<div class="col-md-12 col-xs-12" style="text-align: left">
  <label for="description">Item Description</label><textarea name="description" rows="2" cols="30" id="desc"></textarea> 


</div>
<div class="col-md-12 col-xs-12">

<label for="description">Change Image</label>

<div id="old-image"></div>

  <input type="file" id="uploader">
          <div id="uploader-demo" class="uploader-demo"></div>

                    <span class="loading" id="loader">Uploading...</span>

          

</div>




</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="end"><i class="fa fa-times"></i></div>
<div class="my-box"></div>

<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

  <script src="js/croppie.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

  <script src="js/bootstrap.min.js"></script>


	<script type="text/javascript" src="main.js"></script>


</body>
</html>