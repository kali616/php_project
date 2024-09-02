<?php
include 'inc/lang.php';
$conn = new mysqli("localhost", "root", "", "online_shop");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM products");

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $_SESSION['cart'][] = $product_id;
}
?>

<div class="container my-5">
    <h1><?php echo $lang[$current_lang]['products']; ?></h1>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-lg-4 mb-3">
            <div class="card">
                <img src="<?php echo $row['image']; ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="text-muted"><?php echo $lang[$current_lang]['price']; ?>: <?php echo $row['price']; ?> EGP</p>
                    <p class="card-text"><?php echo $lang[$current_lang]['description']; ?>: <?php echo $row['description']; ?></p>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="add_to_cart" class="btn btn-primary"><?php echo $lang[$current_lang]['add_to_cart']; ?></button>
                    </form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>