<?php
include("../../includes/header.php");
include("../../includes/sidebar.php");
include("../../includes/db.php");

if(isset($_GET['success']))
{
    echo "<div class='alert alert-success'>
            Purchase Added Successfully
          </div>";
}

if(isset($_POST['save']))
{
    if(
        empty($_POST['Lot_no']) ||
        empty($_POST['purchase_date']) ||
        empty($_POST['quantity_crate']) ||
        empty($_POST['rate_per_kg']) ||
        empty($_POST['quantity_kg'])
    )
    {
        echo "<div class='alert alert-danger'>
                Please fill all required fields.
              </div>";
    }
    else
    {
        $lot_no = $_POST['Lot_no'];
        $purchase_date = $_POST['purchase_date'];
        $quantity_crate = $_POST['quantity_crate'];
        $rate_per_kg = $_POST['rate_per_kg'];
        $quantity_kg = $_POST['quantity_kg'];

        $labour = $_POST['labour_cutting_loading'] ?? 0;
        $commission = $_POST['commission'] ?? 0;
        $transport = $_POST['transport'] ?? 0;
        $others = $_POST['others'] ?? 0;

        // Calculations

        $danda_percent = ($quantity_kg * 8) / 100;

        $total_quantity = $quantity_kg + $danda_percent;

        $cost_rs = $total_quantity * $rate_per_kg;

        $grand_total =
            $cost_rs +
            $labour +
            $commission +
            $transport +
            $others;

        $base_price_per_crate = 0;

        $base_price_per_crate = 0;

        if($quantity_crate > 0)
        {
          $base_price_per_crate =
           round(($grand_total / $quantity_crate) + 20);
        }

        $query = "INSERT INTO purchases
        (
            Lot_no,
            purchase_date,
            quantity_crate,
            rate_per_kg,
            quantity_kg,
            danda_percent,
            total_quantity,
            cost_rs,
            labour_cutting_loading,
            commission,
            transport,
            others,
            grand_total,
            base_price_per_crate
        )
        VALUES
        (
            '$Lot_no',
            '$purchase_date',
            '$quantity_crate',
            '$rate_per_kg',
            '$quantity_kg',
            '$danda_percent',
            '$total_quantity',
            '$cost_rs',
            '$labour',
            '$commission',
            '$transport',
            '$others',
            '$grand_total',
            '$base_price_per_crate'
        )";

        if(mysqli_query($conn,$query))
        {
            header("Location: add.php?success=1");
            exit();
        }
        else
        {
            echo "<div class='alert alert-danger'>
                    ".mysqli_error($conn)."
                  </div>";
        }
    }
}
?>

<h2 class="mb-4">Add Purchase</h2>

<form method="POST">

<div class="row">

    <div class="col-md-6 mb-3">
        <label> Lot No </label>
        <input type="varchar" 
        name = "lot_no" 
        class="form-control" 
        required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Date</label>
        <input type="date"
               name="purchase_date"
               class="form-control"
               required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Quantity in Crate</label>
        <input type="number"
               name="quantity_crate"
               class="form-control"
               required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Rate Per KG</label>
        <input type="number"
               step="0.01"
               name="rate_per_kg"
               class="form-control"
               required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Quantity in KG</label>
        <input type="number"
               step="0.01"
               name="quantity_kg"
               class="form-control"
               required>
    </div>

    <div class="col-md-6 mb-3">
        <label>Labor for Cutting & Loading</label>
        <input type="number"
               step="0.01"
               name="labour_cutting_loading"
               class="form-control"
               value="0">
    </div>

    <div class="col-md-6 mb-3">
        <label>Commission</label>
        <input type="number"
               step="0.01"
               name="commission"
               class="form-control"
               value="0">
    </div>

    <div class="col-md-6 mb-3">
        <label>Transport</label>
        <input type="number"
               step="0.01"
               name="transport"
               class="form-control"
               value="0">
    </div>

    <div class="col-md-6 mb-3">
        <label>Others</label>
        <input type="number"
               step="0.01"
               name="others"
               class="form-control"
               value="0">
    </div>

</div>

<button type="submit"
        name="save"
        class="btn btn-success">
    Save Purchase
</button>

</form>

<?php include("../../includes/footer.php"); ?>