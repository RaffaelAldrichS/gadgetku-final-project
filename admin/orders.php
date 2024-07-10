<?php

$currentPage = 'orders';
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Order</h4>
                </div>
                <div class="card-body" id="category_table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Tracking No</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $items = getAllOrders();

                            if (mysqli_num_rows($items) > 0) {
                                foreach ($items as $item) {
                                    $created_date = date('Y-m-d', strtotime($item['created_at']));
                            ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['tracking_no'] ?></td>
                                        <td><?= $item['total_price'] ?></td>
                                        <td><?= $created_date ?></td>
                                        <td>
                                            <?php
                                            if ($item['status'] == '0') {
                                                echo "Under Process";
                                            } else if ($item['status'] == '1') {
                                                echo "Completed";
                                            } else if ($item['status'] == '2') {
                                                echo "Cancelled";
                                            }
                                            ?>
                                        </td>
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
    </div>

    <?php include('includes/footer.php') ?>