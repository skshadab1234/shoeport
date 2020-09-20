	<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "ecomm";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);?>

<?php
//error_reporting(0);
include('includes/session.php');?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<head>
<title>
Profile
</title>
<body class="hold-transition skin-blue layout-top-nav">
	<div class="content-wrapper" style="padding: 50px">
		<div class="box-body table-responsive text-nowrap" style="background-color: white;border-radius: 15px;border: 3px solid white; box-shadow: 0px 8px 60px -10px rgba(13, 28, 39, 0.6);">
<div class="box-header with-border">
<h4 class="box-title"><i class="glyphicon glyphicon-calendar" style="color: steelblue"></i> &nbsp;<b>Your Order</b></h4>
</div><br>
<table class="table table-bordered" id="example1" width="100%" style="border:1px solid #663355;">
<thead style="border:1px solid #663355">
<th style="border:1px solid #663355;text-align:center" >Order ID</th>
<th style="border:1px solid #663355;text-align:center" >Product Buyed</th>
<th style="border:1px solid #663355;text-align:center" >Order Date</th>
<th style="border:1px solid #663355;text-align:center" >Estimate Ship Date</th>
<th style="border:1px solid #663355;text-align:center" >Ship Address</th>
<th style="border:1px solid #663355;text-align:center" >Track Order</th>

</thead>
<tbody style="border: 2px solid #663355">
<?php
$conn = $pdo->open();

try{
$stmt = $conn->prepare("SELECT * FROM sales WHERE user_id=:user_id ORDER BY sales_date DESC");
$stmt->execute(['user_id'=>$user['id']]);
foreach($stmt as $row){
$stmt2 = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE sales_id=:id");
$stmt2->execute(['id'=>$row['id']]);
$total = 0;
foreach($stmt2 as $row2){
$subtotal = $row2['price']*$row2['quantity'];
$total += $subtotal;
$order = $total * ($row2['old_price']-$row2['price'])/  100;
$order1 = $total - $order;
$delivery = 15.00;
$delivery1 = $order1 + $delivery;
$orderid = rand(1,1432);
$orderdate = date('M d, Y', strtotime($row['sales_date']));
$shipdate =  date('M d, Y', strtotime($orderdate. '+5 days'));
}

echo  "
<tr>
<td style=\"border:1px solid #663355;text-align:center\">ORDID".$orderid."</td>
<td style=\"border:1px solid #663355;text-align:center\"><button class='btn btn-sm btn-success  transact'  data-id='".$row['id']."'><i class='fa fa-search' style=\"font-size:14px\"></i> View</button></td>
<td style=\"border:1px solid #663355;text-align:center\">".$orderdate."</td>
<td style=\"border:1px solid #663355;text-align:center\">".$shipdate."</td>
<td style=\"border:1px solid #663355;text-align:center\">Address: ".$user['address']." <br> State:  ".$user['state']." <br> City: ".$user['city']." <br> Pincode: ".$user['pincode']."</td>
<td style=\"border:1px solid #663355;text-align:center\">
<button class='btn btn-sm btn-flat btn-success track' data-id='".$row['id']."'>
<i class='fa fa-map-marker' style=\"font-size:14px;font-weight:700\"></i> 
<span style=\"font-size:14px;font-weight:700\">Track</span></button>
</tr>	
";
}

}

catch(PDOException $e){
echo "There is some problem in connection: " . $e->getMessage();
}

$pdo->close();
?>
</tbody>
</table>
</div>
	</div>

<?php include 'includes/footer.php'; ?>
<?php include 'includes/profile_modal.php'; ?>

<?php include 'includes/scripts.php'; ?>

<script>
$(function(){
$(document).on('click', '.track', function(e){
e.preventDefault();
$('#track').modal('show');
var id = $(this).data('id');
$.ajax({
type: 'POST',
url: 'tracking.php',
data: {id:id},
dataType: 'json',
success:function(response){
// $('#date').html(response.date);
// $('#transid').html(response.transaction);
// $('#detail').prepend(response.list);
// $('#total').html(response.total);
}
});
});

$("#track").on("hidden.bs.modal", function () {
$('.prepend_items').remove();
});
});
</script>

<script>
$(function(){
$(document).on('click', '.cancel', function(e){
e.preventDefault();
$('#cancel').modal('show');
var id = $(this).data('id');
$.ajax({
type: 'POST',
url: 'cancel.php',
data: {id:id},
dataType: 'json',
success:function(response){
$('#date').html(response.date);
$('#transid').html(response.transaction);
$('#detail').prepend(response.list);
$('#total').html(response.total);
}
});
});

$("#transaction").on("hidden.bs.modal", function () {
$('.prepend_items').remove();
});
});
</script>


<script>
$(function(){
$(document).on('click', '.transact', function(e){
e.preventDefault();
$('#transaction').modal('show');
var id = $(this).data('id');
$.ajax({
type: 'POST',
url: 'transaction.php',
data: {id:id},
dataType: 'json',
success:function(response){
$('#date').html(response.date);
$('#transid').html(response.transaction);
$('#detail').prepend(response.list);
$('#total').html(response.total);
}
});
});

$("#transaction").on("hidden.bs.modal", function () {
$('.prepend_items').remove();
});
});
</script>


</body>