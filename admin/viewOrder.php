<?php

$currentPage = 'orders';
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>


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
            <div class="d-flex w-100 align-items-center py-2">
                <h4 class="">View Order: <?= $data['tracking_no'] ?>
                </h4>
                <a href="orders.php" class="btn btn-primary ms-auto">Back</a>
            </div>

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

                                    <div class="">
                                        <form action="code.php" method="post">
                                            <label class="me-3">Status:</label>
                                            <div class="col-md-8 row">
                                                <div class="col-md-8">
                                                    <select name="order_status" id="order_status" class="form-select">
                                                        <option value="0" <?= $data['status'] == '0' ? 'selected' : '' ?>>Under Process</option>
                                                        <option value="1" <?= $data['status'] == '1' ? 'selected' : '' ?>>Completed</option>
                                                        <option value="2" <?= $data['status'] == '2' ? 'selected' : '' ?>>Cancelled</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <button class="btn btn-primary" type="submit" name="update_order_btn">Update</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="tracking_no" value="<?= $data['tracking_no'] ?>">
                                        </form>
                                    </div>

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
                                                            <img src="../uploads/<?= $item['image'] ?>" alt="" width="35" class="img-fluid">
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