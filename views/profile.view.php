<?php
session_start();
$user = isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : [];
$errors = isset($_SESSION['errors_update']) ? $_SESSION['errors_update'] : [];
unset($_SESSION['errors_update']);

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
    <div class="container mx-auto px-4 py-4">
        <div>
            <a href="main.view.php" class="flex items-center">
                <img src="../assets/site_assets/chevron-left.svg" alt="go back">
                <span class="text-lg">
                    Home
                </span>
            </a>
            <p class="text-3xl font-bold mt-4">My Profile:</p>
        </div>
        <div class="flex items-center gap-8 mt-6">
            <img class="w-[50px] h-[50px] rounded-full object-cover"
                src="../assets/users/<?= $user['profile_pic'] ? htmlspecialchars($user['profile_pic']) : 'user_default.svg' ?>" alt="">
            <div>
                <p class="font-bold"><?= htmlspecialchars($user['username']) ?></p>
                <p class="text-stone-600"><?= htmlspecialchars($user['email']) ?></p>
            </div>
        </div>
        <form action="../handlers/updateUser.handler.php" method="post" class="flex flex-col gap-4 mt-6"
            enctype="multipart/form-data" >
            <input type="hidden" name="email" value="<?= htmlspecialchars($user['email']) ?>">
            <div class="flex flex-col gap-2">
                <label class='text-sm text-stone-300' for="username">Username</label>
                <input value="<?= htmlspecialchars($user['username']) ?>" id="username"
                    class='border border-[#8E8E93] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md' type="text"
                    name="username">
            </div>
            <div class="flex flex-col gap-2">
                <label class='text-sm text-stone-300' for="phone">Mobile Number</label>
                <input value="<?php echo isset($user['phone']) ? htmlspecialchars($user['phone']) : '' ?>
                " id="phone" class='border border-[#8E8E93] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md'
                    type="text" name="phone">
            </div>
            <div class="flex flex-col gap-2">
                <label class='text-sm text-stone-300' for="country">Country</label>
                <input value="<?php echo isset($user['country']) ? htmlspecialchars($user['country']) : '' ?>"
                    id="country" class='border border-[#8E8E93] text-[#8E8E93] px-3 py-3 focus:outline-none rounded-md'
                    type="text" name="country">
            </div>
            <div class="flex flex-col gap-2">
                <label class='text-sm text-stone-300' for="profile_pic">Profile Picture</label>
                <input id="profile_pic" type="file" name="profile_pic" accept="image/*">
            </div>
            <?php if (!empty($errors)): ?>
                <div class="text-center">
                    <?php foreach ($errors as $error): ?>
                        <span class='text-red-500'> <?= $error ?>!</span><br>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <button class="bg-[#EF5A5A] py-3 text-white rounded-xl border border-white mt-5" name="confirm_update">Confirm changes</button>
            <button class="border border-[#EF5A5A] py-3 text-[#EF5A5A] rounded-xl mt-5" name="logout">Logout</button>
        </form>
    </div>
</body>

</html>