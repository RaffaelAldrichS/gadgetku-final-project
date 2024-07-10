<?php

$currentPage = 'categories';
include('./functions/userFuntions.php');
include('./includes/header.php');

if (isset($_GET['category'])) {

    $category_slug = $_GET['category'];
    $category_data = getSlugActive('categories', $category_slug);
    $category = mysqli_fetch_array($category_data);
    $category_id = $category['id'];

    if ($category) {

?>


        <div class="py-3">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="link-underline link-underline-opacity-0">Home</a></li>
                        <li class="breadcrumb-item"><a href="categories.php" class="link-underline link-underline-opacity-0">Collections</a></li>
                        <li class="breadcrumb-item active"><?= $category['name'] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><?= $category['name'] ?></h1>
                        <hr>
                        <div class="row">
                            <?php
                            $data = getProdByCatActive($category_id);
                            if (mysqli_num_rows($data) > 0) {
                                foreach ($data as $item) {
                            ?>
                                    <div class="col-md-3 mb-3">
                                        <a href="product-view.php?category=<?= $category_slug ?>&product=<?= $item['slug'] ?>" class="link-underline link-underline-opacity-0">
                                            <div class="card shadow d-flex align-items-center justify-content-center">
                                                <div class="card-body text-center">
                                                    <img src="uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="w-80 mx-auto" height="150px">
                                                    <h4 class="mt-3"><?= $item['name'] ?></h4>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            <?php }
                            } else {
                                echo "No data available";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "Category not found";
    }
} else {
    header("Location: error-view.php");
}
include('./includes/footer.php');

?>