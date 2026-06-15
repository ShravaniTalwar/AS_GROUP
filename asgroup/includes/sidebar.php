<div class="sidebar">

    <h3 class="text-white text-center mt-4 mb-4">
        AS GROUP
    </h3>

    <a href="/asgroup/admin/dashboard.php">
    <i class="fas fa-chart-line"></i>
    Dashboard
</a>

<a href="/asgroup/admin/purchases/view.php">
    <i class="fas fa-boxes"></i>
    Purchases
</a>

<a href="/asgroup/admin/sales/add.php">
    <i class="fas fa-truck"></i>
    Sales
</a>
    

<a href="#">
    <i class="fas fa-file-alt"></i>
    Reports
</a>

<a href="#">
    <i class="fas fa-cog"></i>
    Settings
</a>

<a href="/asgroup/admin/logout.php">
    <i class="fas fa-sign-out-alt"></i>
    Logout
</a>

</div>

<div class="content">

    <div class="topbar">

        <div class="d-flex justify-content-between">

            <h4>Admin Dashboard</h4>

            <div>
                Welcome,
                <b><?php echo $_SESSION['admin']; ?></b>
            </div>

        </div>

    </div>

    <div class="page-content">