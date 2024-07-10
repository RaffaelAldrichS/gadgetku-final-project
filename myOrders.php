<?php
$currentPage = 'cart';
include('./functions/userFuntions.php');
include('./includes/header.php');
include('./checkLogin.php')
?>

<div class="py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="link-underline link-underline-opacity-0">Home</a></li>
                <li class="breadcrumb-item active">My Orders</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-12">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tracking No</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $items = getOrders();

                    if (mysqli_num_rows($items) > 0) {
                        foreach ($items as $item) {
                    ?>
                            <tr>
                                <td><?= $item['tracking_no'] ?></td>
                                <td><?= $item['total_price'] ?></td>
                                <td><?= $item['created_at'] ?></td>
                                <td>
                                    <a href="viewOrder.php?target=<?= $item['tracking_no'] ?>" class="btn btn-primary">View Details</a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5">No orders yet</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include('./includes/footer.php'); ?>