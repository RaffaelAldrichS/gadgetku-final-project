<?php
$currentPage = 'categories';
include('./functions/userFuntions.php');
include('./includes/header.php');

?>

<div class="py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="link-underline link-underline-opacity-0">Home</a></li>
                <li class="breadcrumb-item active">Collections</li>
            </ol>
        </nav>
    </div>
</div>
<div class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Our Collections</h1>
                <hr>
                <div class="row">
                    <?php
                    $data = getAllActive('categories');
                    if (mysqli_num_rows($data) > 0) {
                        foreach ($data as $item) {
                    ?>
                            <div class="col-md-3 mb-3">
                                <a href="products.php?category=<?= $item['slug'] ?>" class="link-underline link-underline-opacity-0">
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
<?php include('./includes/footer.php'); ?>