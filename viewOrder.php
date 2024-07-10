<?php
$currentPage = 'cart';
include('./functions/userFuntions.php');
include('./includes/header.php');
include('./checkLogin.php');

?>

<div class="py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="link-underline link-underline-opacity-0">Home</a></li>
                <li class="breadcrumb-item"><a href="myOrders.php" class="link-underline link-underline-opacity-0">My Orders</a></li>
                <li class="breadcrumb-item active">View Details</li>
            </ol>
        </nav>
    </div>
</div>


<div class="container">
    <?php
    if (isset($_GET['target'])) {
        $tracking_no = $_GET['target'];

        $result = checkTrackingNoValid($tracking_no);
        if (mysqli_num_rows($result) > 0) {
            $data  = mysqli_fetch_array($result);
            $created_date = date('Y-m-d', strtotime($data['created_at']));
    ?>
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center py-2">
                <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> <?= $data['tracking_no'] ?> </h2>
            </div>
            <hr>

            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-between">
                                <div>
                                    <span class="me-3"><?= $created_date ?></span>
                                    <span class="me-3"><?= $data['tracking_no'] ?></span>
                                    <span class="me-3"><?= $data['payment_mode'] ?></span>
                                    <?php
                                    if ($data['status'] == '0') {
                                    ?>
                                        <span class="badge rounded-pill bg-info">
                                            Under Process
                                        </span>
                                    <?php
                                    } else if ($data['status'] == '1') {
                                    ?>
                                        <span class="badge rounded-pill bg-success">
                                            Completed
                                        </span>
                                    <?php
                                    } else if ($data['status'] == '2') {
                                    ?>
                                        <span class="badge rounded-pill bg-danger">
                                            Cancelled
                                        </span>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text"><i class="bi bi-download"></i> <span class="text">Invoice</span></button>
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0 text-muted" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="bi bi-printer"></i> Print</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-borderless">
                                <tbody>
                                    <?php

                                    $items = getProdOrder();
                                    if (mysqli_num_rows($items) > 0) {
                                        foreach ($items as $item) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex mb-2">
                                                        <div class="flex-shrink-0">
                                                            <img src="./uploads/<?= $item['image'] ?>" alt="" width="35" class="img-fluid">
                                                        </div>
                                                        <div class="flex-lg-grow-1 ms-3">
                                                            <h6 class="small mb-0"><a href="#" class="text-reset"><?= $item['name'] ?></a></h6>
                                                            <span class="small">Color: Black</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $item['qty'] ?></td>
                                                <td class="text-end"><?= $item['selling_price'] ?></td>
                                            </tr>
                                    <?php
                                        }
                                    }

                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Subtotal</td>
                                        <td class="text-end"><?= number_format($data['total_price'], 0, ',', '.') ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Shipping</td>
                                        <td class="text-end">50.000</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td colspan="2">TOTAL</td>
                                        <td class="text-end">Rp <?= number_format($data['total_price'] + 50000, 0, ',', '.') ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- Payment -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="h6">Payment Method</h3>
                                    <p><?= $data['payment_mode'] ?><br>
                                        Total: Rp <?= number_format($data['total_price'] + 50000, 0, ',', '.') ?> <span class="badge bg-success rounded-pill">PAID</span></p>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="h6">Billing address</h3>
                                    <address>
                                        <strong><?= $data['name'] ?></strong><br>
                                        <?= $data['address'] ?><br>
                                        Phone: <?= $data['phone'] ?>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <!-- Shipping information -->
                        <div class="card-body">
                            <h3 class="h6">Shipping Information</h3>
                            <strong>JNE</strong>
                            <span><a href="#" class="text-decoration-underline" target="_blank">CGK1234567890
                                </a> <i class="bi bi-box-arrow-up-right"></i> </span>
                            <hr>
                            <h3 class="h6">Address</h3>
                            <address>
                                <strong><?= $data['name'] ?></strong><br>
                                <?= $data['address'] ?><br>
                                Phone: <?= $data['phone'] ?>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        } else {
            echo "No records found";
        }
    } else {
        echo "Something went wrong";
    }
    ?>
</div>

<?php include('./includes/footer.php'); ?>