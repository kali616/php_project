
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <?php
session_start();

// Set default language
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

// Language switcher
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Language variables
$lang = [
    'en' => [
        'cart' => 'Cart',
        'add_to_cart' => 'Add to Cart',
        'checkout' => 'Checkout',
        'products' => 'Products',
        'price' => 'Price',
        'description' => 'Description',
    ],
    'ar' => [
        'cart' => 'عربة التسوق',
        'add_to_cart' => 'أضف إلى السلة',
        'checkout' => 'الدفع',
        'products' => 'المنتجات',
        'price' => 'السعر',
        'description' => 'الوصف',
    ],
];

$current_lang = $_SESSION['lang'];
?>
</head>
<body>
    
</body>
</html>