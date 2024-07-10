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
                <li class="breadcrumb-item"><a href="cart.php" class="link-underline link-underline-opacity-0">Cart</a></li>
                <li class="breadcrumb-item active">Checkout</li>
            </ol>
        </nav>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <form action="./functions/placeorder.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Basic Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="fw-bold">Name</label>
                                    <input type="text" name="name" id="name" placeholder="Enter your full name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="fw-bold">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="fw-bold">Phone</label>
                                    <input type="text" name="phone" id="phone" placeholder="Enter your phone number" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pincode" class="fw-bold">Pin Code</label>
                                    <input type="text" name="pincode" id="pincode" placeholder="Enter your pin code" class="form-control" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="address" class="fw-bold">Address</label>
                                    <textarea name="address" id="address" class="form-control" rows="5" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5>Order Details</h5>
                            <hr>
                            <?php
                            $items = getCartItems();
                            $totalPrice = 0;
                            foreach ($items as $item) {
                            ?>

                                <div class="mb-1 border">
                                    <div class="row align-items-center p-2">
                                        <div class="col-md-3">
                                            <img src="uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="w-75">
                                        </div>
                                        <div class="col-md-4 ">
                                            <label for=""><?= $item['name'] ?></label>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Rp <?= number_format($item['selling_price'], 0, ',', '.') ?></label>
                                        </div>
                                        <div class="col-md-1">
                                            <label for=""><?= $item['prod_qty'] ?></label>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                $totalPrice += $item['selling_price'] * $item['prod_qty'];
                            }
                            ?>
                            <hr>
                            <h5 class="my-3">Total Price: <span class="float-end fw-semibold">Rp <?= number_format($totalPrice, 0, ',', '.') ?>,00</span></h5>
                            <input type="hidden" name="total_price" value="<?= $totalPrice ?>">
                            <input type="hidden" name="payment_mode" value="COD">
                            <div class="">
                                <button class="btn btn-outline-success w-100" type="submit" name="placeOrderBtn">CheckOut</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-normal mb-0">Shopping Cart</h3>
            </div>
            <?php
            $items = getCartItems();
            foreach ($items as $item) {
            ?>
                <div class="card rounded-3 my-2 product_data shadom-sm">
                    <div class="card-body p-4">
                        <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <img src="./uploads/<?= $item['image'] ?>" class="img-fluid rounded-3 w-50" alt="<?= $item['name'] ?>">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <p class="lead fw-normal mb-2"><?= $item['name'] ?></p>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <p class="lead fw-normal mb-2"><?= $item['prod_qty'] ?></p>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                <h6 class="mb-0">Rp <?= number_format($item['selling_price'] * $item['prod_qty'], 0, ',', '.') ?>,00</h6>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <a href="checkout.php" class="">
                <button type="button" class="btn btn-outline-primary btn-block btn-lg w-100 ">Proceed to Pay</button>
            </a>

        </div>
    </div>
</div> -->

<?php include('./includes/footer.php'); ?>