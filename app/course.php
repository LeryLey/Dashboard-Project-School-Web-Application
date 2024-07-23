<?php include('../db/database.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Courses</title>
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
                            <h1 class="text-2xl text-blue-500">Courses</h1>
                            <p class="text-gray-500">Detail below.</p>
                        </div>
                        <div class="space-x-2 flex">
                            <a href="add_course.php" class="border border-blue-500 hover:text-gray-200 text-blue-500 hover:bg-blue-500 bg-transparent duration-300 font-medium uppercase text-sm text-medium py-2 px-4 rounded-md flex items-center gap-1 "><ion-icon name="add-outline" class="text-xl"></ion-icon>Add Course</a>
                        
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
                                        Code
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left tracking-wider">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                        Credit
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                        Department
                                    </th>
                                    
                                    <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT courses.course_id, 
                                    courses.course_code, 
                                    courses.course_name, 
                                    courses.course_dec, 
                                    courses.dept_id, 
                                    courses.course_credit, 
                                    departments.dept_name 
                             FROM courses 
                             LEFT JOIN departments ON courses.dept_id = departments.dept_id";
                                    $result = mysqli_query($conn, $sql);
                                    while($row = $result->fetch_assoc()){
                                        echo "
                                            <tr class=''>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 '>{$row['course_id']}</td>
                                   
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 capitalize '>{$row['course_code']}</td>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 capitalize '>{$row['course_name']}</td>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 capitalize '>{$row['course_credit']}</td>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 capitalize  '>{$row['dept_name']}</td>
                                                <td class=' border-b-[1px] border-gray-800 zh-12 pl-6 capitalize '>{$row['course_dec']}</td>
                                                <td class=' border-b-[1px] border-gray-800 h-12 pl-6 capitalize '>
                                                    
                                                    <a href='edit_course.php?id={$row['course_id']}' class='text-blue-600 hover:text-blue-900 text-xl'>
                                                        <ion-icon name='create-outline'></ion-icon>
                                                    </a>
                                                    <a href='delete_course.php?id={$row['course_id']}' 
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