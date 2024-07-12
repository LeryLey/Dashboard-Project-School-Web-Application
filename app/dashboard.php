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
                <main class="bg-black rounded-tl-md min-h-[89vh] p-4">
                    <div id="card-items" class="grid gap-4 grid-cols-4"></div>
                    <div class="w-full flex gap-4">
                        <div class="w-[50%] rounded-lg h-96 flex bg-primary p-4 relative">
                            <h2 class="text-xl text-gray-200">Transaction History</h2>
                            <span class="absolute top-1/2 bottom-1/2 right-1/2 left-1/2 -translate-x-1/2 w-20 text-gray-600 select-none">No Empty</span>
                        </div>
                        <div class="w-full rounded-lg h-96 p-4 bg-primary">
                            <div class="flex justify-between w-full">
                                <h1 class="text-xl text-gray-200">Open Projects</h1>
                                <p class="text-gray-500 text-sm">Your Data Status</p>
                            </div>
                            <div id="container-projects" class="mt-3 overflow-auto overflow-x-hidden"></div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <?php  include("../includes/footer.php")?>
    </body>
</html>
