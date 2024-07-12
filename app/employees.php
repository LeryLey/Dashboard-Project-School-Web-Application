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
                <div class="bg-primary rounded-md h-full p-4 overflow-auto">
                    <div  class="flex items-center justify-between ">
                        <div>
                            <h1 class="text-2xl text-blue-500">Employees List</h1>
                            <p class="text-gray-500">Detail below.</p>
                        </div>
                        <div class="space-x-2 flex">
                            <a href="#" class="border border-green-500 text-green-500 hover:text-white bg-transparent hover:bg-green-500 duration-300 font-medium uppercase text-sm text-medium py-2 px-4 rounded-md ">View All</a>
                            <a href="add.php" class="border border-blue-500 text-gray-200 hover:text-blue-500 bg-blue-500 hover:bg-transparent duration-300 font-medium uppercase text-sm text-medium py-2 px-4 rounded-md flex items-center gap-1 "><ion-icon name="add-outline" class="text-xl"></ion-icon>Add Employee</a>
                        
                        </div>
                    </div>
                    <div class="mt-5">
                        <table class="min-w-full text-sm text-gray-400">
                            <thead class="text-xs uppercase font-medium rounded-md">
                                <tr class="border-b-[1px] border-gray-800">
                                    <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left tracking-wider">
                                        Employee
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left tracking-wider">
                                        Gender
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                        Date of Birth
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                        Phone
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                        Position
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                        Address
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM employees";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = $result->fetch_assoc()){
                                        echo "
                                            <tr class=''>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 '>{$row['id']}</td>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 capitalize '>{$row['fname']} {$row['lname']}</td>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 capitalize '>{$row['gender']}</td>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 capitalize '>{$row['dob']}</td>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 capitalize '>{$row['phone']}</td>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 lowercase  '>{$row['email']}</td>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 capitalize '>{$row['position']}</td>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 capitalize '>{$row['address']}</td>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 capitalize '>
                                                    <a href='view.php?id={$row['id']}' class='text-green-600 hover:text-green-900 text-xl'>
                                                        <ion-icon name='eye-outline'></ion-icon>
                                                    </a>
                                                    <a href='edit.php?id={$row['id']}' class='text-blue-600 hover:text-blue-900 text-xl'>
                                                        <ion-icon name='create-outline'></ion-icon>
                                                    </a>
                                                    <a href='delete.php?id={$row['id']}' 
                                                    class='text-red-600 hover:text-red-900 text-xl'
                                                    onclick='return confirm(\"Are you sure you want to delete this employee?\");'>
                                                        <ion-icon name='trash-outline'></ion-icon>
                                                    </a>
                                                </td>
                                            </tr>
                                        ";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>
    <?php  include("../includes/footer.php")?>
</body>
</html>