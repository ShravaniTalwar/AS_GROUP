<?php
include("../../includes/header.php");
include("../../includes/sidebar.php");
include("../../includes/db.php");

$id = $_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM purchases WHERE id='$id'"
);

$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $purchase_date = $_POST['purchase_date'];
    $quantity_crate = $_POST['quantity_crate'];
    $rate_per_kg = $_POST['rate_per_kg'];
    $quantity_kg = $_POST['quantity_kg'];

    $labour = $_POST['labour_cutting_loading'];
    $commission = $_POST['commission'];
    $transport = $_POST['transport'];
    $others = $_POST['others'];

    $danda_percent = ($quantity_kg * 8) / 100;

    $total_quantity = $quantity_kg + $danda_percent;

    $cost_rs = $total_quantity * $rate_per_kg;

    $grand_total =
        $cost_rs +
        $labour +
        $commission +
        $transport +
        $others;

    $base_price_per_crate =
        round((($grand_total / $quantity_crate) + 20), 2);

    $query = "UPDATE purchases SET

        purchase_date='$purchase_date',
        quantity_crate='$quantity_crate',
        rate_per_kg='$rate_per_kg',
        quantity_kg='$quantity_kg',
        danda_percent='$danda_percent',
        total_quantity='$total_quantity',
        cost_rs='$cost_rs',
        labour_cutting_loading='$labour',
        commission='$commission',
        transport='$transport',
        others='$others',
        grand_total='$grand_total',
        base_price_per_crate='$base_price_per_crate'

        WHERE id='$id'
    ";

    mysqli_query($conn,$query);

    header("Location:view.php");
    exit();
}
?>

<h2 class="mb-4">Edit Purchase</h2>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">
<label>Date</label>
<input type="date"
       name="purchase_date"
       class="form-control"
       value="<?php echo $row['purchase_date']; ?>"
       required>
</div>

<div class="col-md-6 mb-3">
<label>Quantity in Crate</label>
<input type="number"
       name="quantity_crate"
       class="form-control"
       value="<?php echo $row['quantity_crate']; ?>"
       required>
</div>

<div class="col-md-6 mb-3">
<label>Rate Per KG</label>
<input type="number"
       step="0.01"
       name="rate_per_kg"
       class="form-control"
       value="<?php echo $row['rate_per_kg']; ?>"
       required>
</div>

<div class="col-md-6 mb-3">
<label>Quantity in KG</label>
<input type="number"
       step="0.01"
       name="quantity_kg"
       class="form-control"
       value="<?php echo $row['quantity_kg']; ?>"
       required>
</div>

<div class="col-md-6 mb-3">
<label>Labour</label>
<input type="number"
       step="0.01"
       name="labour_cutting_loading"
       class="form-control"
       value="<?php echo $row['labour_cutting_loading']; ?>">
</div>

<div class="col-md-6 mb-3">
<label>Commission</label>
<input type="number"
       step="0.01"
       name="commission"
       class="form-control"
       value="<?php echo $row['commission']; ?>">
</div>

<div class="col-md-6 mb-3">
<label>Transport</label>
<input type="number"
       step="0.01"
       name="transport"
       class="form-control"
       value="<?php echo $row['transport']; ?>">
</div>

<div class="col-md-6 mb-3">
<label>Others</label>
<input type="number"
       step="0.01"
       name="others"
       class="form-control"
       value="<?php echo $row['others']; ?>">
</div>

</div>

<button type="submit"
        name="update"
        class="btn btn-success">
        Update Purchase
</button>

</form>

<?php include("../../includes/footer.php"); ?>