<?php

$currentPage = 'products';
include('../middleware/adminMiddleware.php');
include('includes/header.php');

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Products</h4>
                </div>
                <div class="card-body" id="products_table">
                    <table class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $product = getAll('products');
                            if (mysqli_num_rows($product) > 0) {
                                foreach ($product as $item) {
                            ?>
                                    <tr>
                                        <th><?= $item['id'] ?></th>
                                        <th><?= $item['name'] ?></th>
                                        <th><img src="../uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" width="50px" height="50px"></th>
                                        <th><?= $item['status'] == '0' ? 'Visible' : 'Hidden' ?></th>
                                        <th>
                                            <div class="d-flex justify-content-start gap-2">
                                                <a href="editProduct.php?id=<?= $item['id'] ?>" class="btn btn-warning">Edit</a>
                                                <button class="btn btn-primary delete_product_btn" type="button" value="<?= $item['id'] ?>">Delete</button>
                                            </div>
                                        </th>
                                    </tr>
                            <?php }
                            } else {
                                echo "No records found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>