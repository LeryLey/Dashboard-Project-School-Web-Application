<?php 
    include('../db/database.php'); 
    $id = $_GET['id'];

?>
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
            <?php
                $sql = "SELECT * FROM employees WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $row = $result->fetch_assoc();
            ?>
            <main class="bg-black rounded-tl-md h-[89vh] px-4 pt-16 pb-4 flex">
                <article class="w-full h-full bg-gray-800 rounded-lg relative p-4">
                    <div class="flex items-center justify-between">
                        <a href="#" class="text-pink-500 flex items-center gap-1">
                            <ion-icon name="people" class="text-xl"></ion-icon>
                            Information
                        </a>
                        <div class="w-32 h-32 rounded-full overflow-hidden absolute -translate-x-1/2 left-1/2 right-1/2 border-black border-4 -top-14">
                            <img src="../img/<?php echo $row['photo'] ? $row['photo'] : "user-profile.jpg" ?>" class="h-full w-full object-cover hover:scale-[1.1] duration-300">
                        </div>
                        <a href="#" class="text-pink-500 flex items-center gap-1">
                            <ion-icon name="chatbubbles" class="text-xl"></ion-icon>
                            Message
                        </a>
                    </div>
                    <div class="w-full flex flex-col items-center justify-center mt-10 space-y-2">
                        <h1 class="text-2xl font-bold text-white uppercase text-gray">
                            <?php echo htmlspecialchars($row['fname'], ENT_QUOTES, 'UTF-8', ); ?>
                            <?php echo htmlspecialchars($row['lname'], ENT_QUOTES, 'UTF-8', ); ?>
                        </h1>
                        <div class="flex flex-col justify-center items-center text-gray-400 gap-1 ">
                            <div class="flex items-center gap-1">
                                <ion-icon name="location"></ion-icon>
                                <p><?php echo htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8', ); ?></p>
                            </div>
                            <p class="w-[30em] text-center text-gray-300 text-[1em]">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut maxime nulla excepturi numquam. Expedita officiis magnam, nesciunt exercitationem in accusantium ea recusandae dicta. Vero sint magnam dolor distinctio magni nam!</p>
                        </div>
                        <div class="translate-y-5 flex gap-4">
                            <div class="bg-gray-700 rounded-full p-2 w-10 h-10 flex items-center justify-center text-gray-400 hover:bg-gray-500 hover:text-white duration-300 relative group">
                                <ion-icon name="mail" class="text-blue-500"></ion-icon>
                                <a href="#" 
                                class="absolute bottom-full bg-black px-4 py-1 rounded-full opacity-0 pointer-events-none group-hover:pointer-events-auto group-hover:opacity-100 group-hover:-translate-y-4 duration-300 ease-out"><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8', ); ?><ion-icon name="caret-down" class="absolute top-full left-1/2 right-1/2 -translate-x-1/2 text-gray-500"></ion-icon></a>
                                
                            </div>
                            <div class="bg-gray-700 rounded-full  p-2 w-10 h-10 flex items-center justify-center text-gray-400 hover:bg-gray-500 hover:text-white duration-300 relative group">
                                <ion-icon name="call" class="text-purple-500"></ion-icon>
                                <a href="#" 
                                class="absolute bottom-full w-32 text-center  bg-black px-4 py-1 rounded-full opacity-0 pointer-events-none group-hover:pointer-events-auto group-hover:opacity-100 group-hover:-translate-y-4 duration-300 ease-out"><?php echo htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8', ); ?><ion-icon name="caret-down" class="absolute top-full left-1/2 right-1/2 -translate-x-1/2 text-gray-500"></ion-icon></a>
                                
                            </div>
                            <div class="bg-gray-700 rounded-full p-2 w-10 h-10 flex items-center justify-center text-gray-400 hover:bg-gray-500 hover:text-white duration-300 relative group">
                                <ion-icon name="time" class="text-orange-500"></ion-icon>
                                <a href="#" 
                                class="absolute bottom-full w-32 text-center  bg-black px-4 py-1 rounded-full opacity-0 pointer-events-none group-hover:pointer-events-auto group-hover:opacity-100 group-hover:-translate-y-4 duration-300 ease-out"><?php echo htmlspecialchars($row['dob'], ENT_QUOTES, 'UTF-8', ); ?><ion-icon name="caret-down" class="absolute top-full left-1/2 right-1/2 -translate-x-1/2 text-gray-500"></ion-icon></a>
                                
                            </div>
                        </div>
                        <div class="translate-y-20 ">
                            <a href="employees.php" class="rounded-full uppercase text-sm font-medium flex items-center gap-2 text-red-500 group">
                                <span class="group-hover:-translate-x-5 duration-500 ease-out">
                                    Close
                                </span>
                                <ion-icon name="add-outline" class="absolute opacity-0 group-hover:opacity-100 group-hover:translate-x-6 duration-500 ease-out text-xl rotate-45"></ion-icon>
                            </a>
                        </div>
                    </div>
                </article>
            </main>
        </div>
    </div>
    <?php  include("../includes/footer.php")?>
</body>
</html>