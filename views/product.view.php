<?php
require_once '../controllers/ProductController.php';
require_once '../config/db.config.php';

$user = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : [];

$db = getDbConnection();
$productControler = new ProductController($db);

$id = $_GET['id'];
$product = $productControler->getProductById($id);

$action = $user['role'] == 'admin' ? '../handlers/product.handler.php' : '../handlers/cart.handler.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/site_assets/logo.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/script.js" defer></script>
    <title><?= htmlspecialchars($product['name']) ?> book</title>
</head>

<body>
    <div class="container mx-auto px-4">
        <nav class="">
            <?php require_once '../components/navbar.html' ?>
        </nav>
        <section id="product_page">
            <div class="flex justify-between items-center mt-10 pr-2">
                <a href="main.view.php">
                    <img class='w-[40px]' src="../assets/site_assets/chevron-left.svg" alt="go back">
                </a>
                <img class='w-[40px]' src="../assets/site_assets/heart-black.svg" alt="add to like">
            </div>

            <div class="flex flex-col sm:flex-row min-h-[50vh] sm:mt-15 gap-10 justify-between">
                <div class="flex items-center flex-col rounded-xl gap-2 mt-10 sm:w-[40%] sm:self-center sm:pl-5">
                <img class='w-[50%] rounded-xl sm:w-full xl:w-[60%]' src="../assets/products/<?= htmlspecialchars($product['img']) ?>" alt="book cover">
                    <div class="text-center">
                        <p class="font-bold text-xl"><?= htmlspecialchars($product['name']); ?></p>
                        <p class="text-[#9D9D9D]"><?= htmlspecialchars($product['author']); ?></p>
                        <p class="text-[#9D9D9D]">USD <?= htmlspecialchars($product['price']); ?></p>
                    </div>
                </div>
                <form action='<?= htmlspecialchars($action); ?>' method="post" class="flex flex-col items-center sm:h-full sm:self-center sm:max-w-[400px] ">
                    <p class="font-bold text-xl mt-5">Description:</p>
                    <p class="text-md"><?= htmlspecialchars($product['description']); ?></p>
                    <input type="hidden" name="productId" value="<?= $id ?>">
                    <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                    <?php if ($user['role'] == 'admin') : ?>
                        <button name="update_product" class="bg-blue-500 w-full text-white py-4 rounded-xl mt-5">Update</button>
                        <button name="delete_product" class="bg-[#EB5757] w-full text-white py-4 rounded-xl mt-5">Delete</button>
                    <?php else : ?>    
                        <button name="add_to_cart" class="bg-[#EB5757] w-full text-white py-4 rounded-xl mt-5">Add to cart</button>
                    <?php endif; ?>
                </form>
            </div>
        </section>

    </div>
</body>

</html>