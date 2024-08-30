<?php
require_once '../controllers/ProductController.php';
require_once '../config/db.config.php';

$user = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : [];

$db = getDbConnection();
$productControler = new ProductController($db);

$products = $productControler->getAllProducts();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/site_assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../scripts/script.js" defer></script>
    <title>Alpha Bookstore</title>
</head>

<body>
    <div class="container mx-auto px-4">
        <?php
        require_once "../components/navbar.html";
        ?>
        <div class=" mt-3">
            <p class="flex items-center gap-3">
                <span class="text-2xl sm:text-3xl font-bold text-[#EB5757]">Hello, <?= $user['username'] ?></span>
                <img src="../assets/site_assets/hand-emoji.svg" class="w-[30px]" alt="hello" />
            </p>
            <p class="text-sm sm:text-md mt-3">What plans do you have for today ?</p>
        </div>
        <div class="mt-5 flex flex-col gap-5 lg:flex-row lg:items-center">
            <form class="flex items-center justify-around border border-[#8E8E93] py-4 gap-5 px-4 rounded-lg grow"
                method="post">
                <button class="cursor-pointer">
                    <img src="../assets/site_assets/search.svg" alt="search">
                </button>
                <input type="text" placeholder="Search here" class="grow focus:outline-none">
                <img src="../assets/site_assets/filter.svg" alt="search" class="cursor-pointer"">
            </form>
            <?php if ($user['role'] == 'admin') : ?>
                <a href=" addProduct.view.php" target="_blank"
                    class="bg-emerald-500 text-center px-16 py-4 text-white rounded-lg hover:bg-emerald-800">Add new
                product
                </a>
            <?php endif;?>
        </div>


        <div class="flex flex-col flex-wrap mt-10 gap-5 sm:flex-row lg:gap-4">
            <?php foreach ($products as $product): ?>
                <a href="product.view.php?id=<?= $product['id']; ?>" class='flex flex-col justify-between p-2 border rounded-xl px-2 py-2 h-[400px] sm:w-[48%] lg:w-[32%] xl:w-[24%]'>
                    <img src="../assets/products/<?= htmlspecialchars($product['img']); ?>" class="rounded-xl object-contain h-[70%]" />
                    <p class="font-bold text-xl"><?= htmlspecialchars($product['name']); ?></p>
                    <p class="text-[#9D9D9D]"><?= htmlspecialchars($product['author']); ?></p>
                    <p class="text-[#9D9D9D]">USD <?= htmlspecialchars($product['price']); ?></p>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
</body>

</html>
