<?php
include("../../includes/header.php");
include("../../includes/sidebar.php");
include("../../includes/db.php");

$result = mysqli_query(
    $conn,
    "SELECT * FROM purchases ORDER BY id ASC"
);
?>

<h2 class="mb-4">Purchase Records</h2>

<a href="add.php" class="btn btn-success mb-3">
    Add New Purchase
</a>

<div class="table-responsive">

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>
    <th>Sr No</th>
    <th>Lot no</th>
    <th>Date</th>
    <th>Crates</th>
    <th>Rate/KG</th>
    <th>Quantity KG</th>
    <th>Danda 8%</th>
    <th>Total Qty</th>
    <th>Cost</th>
    <th>Labour</th>
    <th>Commission</th>
    <th>Transport</th>
    <th>Others</th>
    <th>Grand Total</th>
    <th>Base Price</th>
    <th>Action</th>
</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['Lot_no']; ?></td>
<td><?php echo $row['purchase_date']; ?></td>
<td><?php echo $row['quantity_crate']; ?></td>
<td><?php echo $row['rate_per_kg']; ?></td>
<td><?php echo $row['quantity_kg']; ?></td>
<td><?php echo $row['danda_percent']; ?></td>
<td><?php echo $row['total_quantity']; ?></td>
<td>₹<?php echo $row['cost_rs']; ?></td>
<td>₹<?php echo $row['labour_cutting_loading']; ?></td>
<td>₹<?php echo $row['commission']; ?></td>
<td>₹<?php echo $row['transport']; ?></td>
<td>₹<?php echo $row['others']; ?></td>
<td>₹<?php echo $row['grand_total']; ?></td>
<td>₹<?php echo $row['base_price_per_crate']; ?></td>
<td>
    <a href="edit.php?id=<?php echo $row['id']; ?>"
       class="btn btn-primary btn-sm">
       Edit
    </a>

    <a href="delete.php?id=<?php echo $row['id']; ?>"
       class="btn btn-danger btn-sm"
       onclick="return confirm('Are you sure you want to delete this purchase?');">
       Delete
    </a>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<?php include("../../includes/footer.php"); ?>