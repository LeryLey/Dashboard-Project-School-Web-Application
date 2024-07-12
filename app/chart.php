<?php include('../db/database.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <?php  include("../includes/head.php") ?>
</head>  
<body class="bg-primary min-h-screen">
    <div class="grid grid-cols-12">
        <aside class="col-span-2 bg-primary h-full">
            <?php include("../includes/sidebar.php") ?>
        </aside>
        <div class="col-span-10">
            <div class="py-2 px-4 bg-primary">
                <?php include("../includes/navbar.php") ?>
            </div>
            <main class="bg-black rounded-tl-md h-[89vh] p-4 ">
                <div class="w-full h-full bg-primary rounded-lg flex items-center justify-center">
                    <span class="text-gray-600 select-none">No Empty</span>
                </div>  
            </main>
        </div>
    </div>
    <?php  include("../includes/footer.php")?>
</body>
</html>