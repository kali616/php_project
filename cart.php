<?php include 'header.php' ?>
<?php include 'navbar.php' ?>

<?php
session_start();
$conn = new mysqli("localhost", "root", "", "examdb"); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Fetch product details for items in the cart
$cart_items = [];
if (!empty($_SESSION['cart'])) {
    $placeholders = implode(',', array_fill(0, count($_SESSION['cart']), '?'));
    $stmt = $conn->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->bind_param(str_repeat('i', count($_SESSION['cart'])), ...$_SESSION['cart']);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($item = $result->fetch_assoc()) {
        $cart_items[] = $item;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container my-5">
    <h1>Shopping Cart</h1>

    <?php if (empty($cart_items)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($cart_items as $item):
                    $total += $item['price'];
                ?>
                <tr>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['price']; ?> EGP</td>
                    <td>
                        <form method="POST" action="update_cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <input type="number" name="quantity" value="1" min="1" style="width: 60px;">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </td>
                    <td><?php echo $item['price']; ?> EGP</td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" class="text-right">Total:</td>
                    <td><?php echo $total; ?> EGP</td>
                </tr>
            </tbody>
        </table>

        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<section id="page-header" class="about-header"> 
        <h2>#Cart</h2>
        <p>Let's see what you have.</p>
    </section>
 
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Desc</td>
                    <td>Quantity</td>
                    <td>price</td>
                    <td>Subtotal</td>
                    <td>Remove</td>
                    <td>Edit</td>
                </tr>
            </thead>
   
            <tbody>
                <tr>
                    <td><img src="" alt="product1"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                   
                    
                    <td></td>
                    
                    <!-- Remove any cart item  -->
                    <td><button type="submit"  class="btn btn-danger">Remove</button></td>
                    
                    
                
                </tr>
            </tbody>
            <!-- confirm order  -->
            <td><button type="submit" name="" class="btn btn-success">Confirm</button></td>
            
        </table>
    </section>

    <!-- <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Coupon</h3>
            <input type="text" placeholder="Enter coupon code">
            <button class="normal">Apply</button>
        </div>
        <div id="subTotal">
            <h3>Cart totals</h3>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$118.25</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$118.25</strong></td>
                </tr>
            </table>
            <button class="normal">proceed to checkout</button>
        </div>
    </section> -->

    <?php include "footer.php" ?>

