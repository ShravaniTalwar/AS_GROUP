<?php
include("../../includes/header.php");
include("../../includes/sidebar.php");
include("../../includes/db.php");

if(isset($_POST['save']))
{
    $sale_date = $_POST['sale_date'];
    $customer_name = $_POST['customer_name'];
    $vehicle_no = $_POST['vehicle_no'];
    $lot_no = $_POST['lot_no'];

    $crates_sold = $_POST['crates_sold'];
    $empty_crates_returned = $_POST['empty_crates_returned'];

    $rate_per_crate = $_POST['rate_per_crate'];
    $paid_amount = $_POST['paid_amount'];

    $total_amount = $crates_sold * $rate_per_crate;

    $remaining_amount = $total_amount - $paid_amount;

    $empty_crates_pending =
        $crates_sold - $empty_crates_returned;

    // PURCHASED STOCK
    $purchase_query = mysqli_query(
        $conn,
        "SELECT quantity_crate
         FROM purchases
         WHERE lot_no='$lot_no'
         LIMIT 1"
    );

    $purchase = mysqli_fetch_assoc($purchase_query);

    $total_purchased =
        $purchase['quantity_crate'];

    // SOLD STOCK
    $sold_query = mysqli_query(
        $conn,
        "SELECT IFNULL(SUM(crates_sold),0) as total_sold
         FROM sales
         WHERE lot_no='$lot_no'"
    );

    $sold = mysqli_fetch_assoc($sold_query);

    $total_sold =
        $sold['total_sold'];

    $available_stock =
        $total_purchased - $total_sold;

    if($crates_sold > $available_stock)
    {
        echo "<div class='alert alert-danger'>
                Not enough stock available.
                Available Stock : $available_stock
              </div>";
    }
    else
    {
        $query = "INSERT INTO sales
        (
            sale_date,
            customer_name,
            vehicle_no,
            lot_no,
            crates_sold,
            empty_crates_returned,
            empty_crates_pending,
            rate_per_crate,
            total_amount,
            paid_amount,
            remaining_amount
        )
        VALUES
        (
            '$sale_date',
            '$customer_name',
            '$vehicle_no',
            '$lot_no',
            '$crates_sold',
            '$empty_crates_returned',
            '$empty_crates_pending',
            '$rate_per_crate',
            '$total_amount',
            '$paid_amount',
            '$remaining_amount'
        )";

        if(mysqli_query($conn,$query))
        {
            echo "<div class='alert alert-success'>
                    Sale Added Successfully
                  </div>";
        }
    }
}
?>

<h2 class="mb-4">Add Sale</h2>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">
<label>Date</label>
<input type="date"
       name="sale_date"
       class="form-control"
       required>
</div>

<div class="col-md-6 mb-3">
<label>Customer Name</label>
<input type="text"
       name="customer_name"
       class="form-control"
       required>
</div>

<div class="col-md-6 mb-3">
<label>Vehicle Number</label>
<input type="text"
       name="vehicle_no"
       class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Lot Number</label>

<select name="lot_no"
        class="form-control"
        required>

<option value="">
Select Lot
</option>

<?php

$lots = mysqli_query(
    $conn,
    "SELECT lot_no
     FROM purchases"
);

while($lot = mysqli_fetch_assoc($lots))
{
?>

<option value="<?php echo $lot['lot_no']; ?>">
    <?php echo $lot['lot_no']; ?>
</option>

<?php } ?>

</select>
</div>

<div class="col-md-6 mb-3">
<label>Crates Sold</label>
<input type="number"
       name="crates_sold"
       class="form-control"
       required>
</div>

<div class="col-md-6 mb-3">
<label>Empty Crates Returned</label>
<input type="number"
       name="empty_crates_returned"
       value="0"
       class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Rate Per Crate</label>
<input type="number"
       step="0.01"
       name="rate_per_crate"
       class="form-control"
       required>
</div>

<div class="col-md-6 mb-3">
<label>Paid Amount</label>
<input type="number"
       step="0.01"
       name="paid_amount"
       class="form-control"
       required>
</div>

</div>

<button type="submit"
        name="save"
        class="btn btn-success">
    Save Sale
</button>

</form>

<?php include("../../includes/footer.php"); ?>