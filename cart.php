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
                <li class="breadcrumb-item active">Cart</li>
            </ol>
        </nav>
    </div>
</div>
<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-normal mb-0">Shopping Cart</h3>
            </div>
            <div id="myCart">
                <?php
                $items = getCartItems();
                if (mysqli_num_rows($items) > 0) {

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
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                        <input type="hidden" class="prod_id_value" value="<?= $item['pid'] ?>">
                                        <button class="btn btn-link px-2 decrement_btn update_qty">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input value=<?= $item['prod_qty'] ?> type="text" class="form-control form-control-sm input_qty text-center bg-white" disabled />
                                        <button class="btn btn-link px-2 increment_btn update_qty">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h6 class="mb-0">Rp <?= number_format($item['selling_price'], 0, ',', '.') ?>,00</h6>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <button class="btn text-danger delete_cart_btn" value="<?= $item['cid'] ?>"><i class="fas fa-trash fa-lg"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php

                        ?>
                        <a href="checkout.php" class="">
                            <button type="button" class="btn btn-outline-primary btn-block btn-lg w-100 ">Proceed to Pay</button>
                        </a>
                    <?php
                    }
                } else {
                    ?>
                    <div class="card rounded-3 my-2 product_data shadom-sm">
                        <div class="card-body p-4">
                            <h4 class="py-3 text-center">Your cart is empty</h4>
                        </div>
                    </div>
                    <a href="categories.php" class="">
                        <button type="button" class="btn btn-outline-primary btn-block btn-lg w-100 ">Go to collections</button>
                    </a>
                <?php
                }
                ?>
            </div>



        </div>
    </div>

</div>

<?php include('./includes/footer.php'); ?>