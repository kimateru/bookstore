<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/site_assets/logo.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Alpha Bookstore</title>
</head>

<body>
    <div class="container h-screen mx-auto px-4 flex flex-col mt-[100px]">
        <div class ='flex justify-center'>
            <img src="../assets/site_assets/logo-red.png" alt="Logo" class="w-[120px]">
        </div>
        <form action="../handlers/userRegister.handler.php" method="post" class="flex flex-col gap-6 mt-8 mb-4">
            <input class='border border-[#8E8E93] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md' placeholder="Book Lover" name="username" type="text">
            <input class='border border-[#8E8E93] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md' placeholder="book@book.md" name="email" type="email">
            <input class='border border-[#8E8E93] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md' placeholder="Your secret.." name="pwd" type="password">
            <button class="mt-3 bg-[#EF5A5A] text-white text-center rounded-xl py-3">Submit</button>
        </form>
        <?php if (!empty($errors)) : ?>
            <div class="text-center">
                <?php foreach ($errors as $error) : ?>
                    <span class='text-red-500'> <?= $error ?>!</span><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <p class='mt-4 text-sm text-[#8E8E93] text-center'>Already have an account? <a class="font-bold" href="login.view.php">Log in here</a></p>
    </div>
</body>

</html>