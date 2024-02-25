<?php include 'includes/session.php'; ?>
<?php
    $slug = isset($_GET['category']) ? $_GET['category'] : '';

    $conn = $pdo->open();

    try {
        $stmt = $conn->prepare("SELECT * FROM category WHERE cat_slug = :slug");
        $stmt->execute(['slug' => $slug]);
        $cat = $stmt->fetch();

        if ($cat) {
            $catid = $cat['id'];

            // Fetch products for the specified category
            $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
            $stmt->execute(['catid' => $catid]);
            $products = $stmt->fetchAll();
        } else {
            // Handle the case where the category is not found
            echo "Category not found.";
            exit();
        }
    } catch (PDOException $e) {
        echo "There is some problem in connection: " . $e->getMessage();
    }

    $pdo->close();
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    <?php include 'includes/navbar.php'; ?>
    <div class="content-wrapper">
        <div class="container">
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        <h1 class="page-header"><?php echo $cat['name']; ?></h1>
                        <div class="row">
                            <?php
                            foreach ($products as $row) {
                                $image = (!empty($row['photo'])) ? 'images/' . $row['photo'] : 'images/noimage.jpg';
                                echo "
                                    <div class='col-sm-4'>
                                        <div class='box box-solid'>
                                            <div class='box-body prod-body'>
                                                <img src='" . $image . "' width='100%' height='230px' class='thumbnail'>
                                                <h5><a href='product.php?product=" . $row['slug'] . "'>" . $row['name'] . "</a></h5>
                                            </div>
                                            <div class='box-footer'>
                                                <b>₱ " . number_format($row['price'], 2) . "</b>
                                            </div>
                                        </div>
                                    </div>
                                ";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <?php include 'includes/sidebar.php'; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
