<?php

$currentPage = 'categories';
include('./functions/userFuntions.php');
include('./includes/header.php');

if (isset($_GET['product'])) {

    $category_slug = $_GET['category'];
    $product_slug = $_GET['product'];
    $product_data = getSlugActive('products', $product_slug);
    $product = mysqli_fetch_array($product_data);
    if ($product) {

?>

        <div class="py-3">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="link-underline link-underline-opacity-0">Home</a></li>
                        <li class="breadcrumb-item"><a href="categories.php" class="link-underline link-underline-opacity-0">Collections</a></li>
                        <li class="breadcrumb-item"><a href="products.php?category=<?= $category_slug ?>" class="link-underline link-underline-opacity-0"><?= $category_slug ?></a></li>
                        <li class="breadcrumb-item active"><?= $product['name'] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class=" py-4">
            <div class="container product_data">
                <div class="row justify-content-around align-items-center">
                    <div class="col-md-4">
                        <div class="p-4 rounded-3 shadow  mb-4">
                            <img src="./uploads/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="w-100">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="d-flex justify-content-between ">
                            <h4 class="fw-semibold"><?= $product['name'] ?></h4>
                            <span class="float-end text-danger"><?php if ($product['trending']) {
                                                                    echo 'Trending';
                                                                } ?></span>
                        </div>
                        <hr>
                        <p><?= $product['small_description'] ?></p>
                        <div class="fs-5 mb-2">
                            <span class="text-decoration-line-through">Rp <?= number_format($product['original_price'], 0, ',', '.') ?>,00</span>
                            <span>Rp <?= number_format($product['selling_price'], 0, ',', '.') ?>,00</span>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3" style="width: 130px;">
                                    <button class="input-group-text decrement_btn">-</button>
                                    <input type="text" class="form-control text-center bg-white input_qty" value=1 disabled>
                                    <button class="input-group-text increment_btn">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button class="btn btn-primary px-4 add_to_cart" value="<?= $product['id'] ?>"><i class="fa fa-shopping-cart me-2"></i>Add to cart</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-danger px-4"><i class="fa fa-heart me-2"></i>Wishlist</button>
                            </div>
                        </div>
                        <hr>
                        <h6 class="fw-medium">Product Description:</h6>
                        <p><?= $product['description'] ?></p>
                    </div>
                </div>
            </div>
        </div>

<?php
    } else {
        echo "Product not found";
    }
} else {
    header("Location: error-view.php");
}
include('./includes/footer.php');

?>