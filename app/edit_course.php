<?php 
    include('../db/database.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <?php  include("../includes/head.php") ?>
</head>  
<style>
    #option-dropdown.active{
        height: 300px;
    }
</style>
<body class="bg-primary min-h-screen">
    <div class="grid grid-cols-12">
        <aside class="col-span-2 bg-primary h-full">
            <?php include("../includes/sidebar.php") ?>
        </aside>
        <div class="col-span-10">
            <div class="py-2 px-4 bg-primary">
                <?php include("../includes/navbar.php") ?>
            </div>
            <main class="bg-black rounded-tl-md h-[89vh] p-4 overflow-auto ">
                <div class="h-full">
                    <?php 
                        function alert($message){
                            echo "<script>alert('$message')</script>";
                        }
                        $id = $_GET['id'];
                        if(isset($_POST['save'])){
                            $course_code = filter_input(INPUT_POST, "course_code", FILTER_SANITIZE_SPECIAL_CHARS);
                            $course_name = filter_input(INPUT_POST, "course_name", FILTER_SANITIZE_SPECIAL_CHARS);
                            $credit = filter_input(INPUT_POST, "credit", FILTER_SANITIZE_NUMBER_INT);
                            $department_id = filter_input(INPUT_POST, "department", FILTER_SANITIZE_NUMBER_INT);
                            $professors = filter_input(INPUT_POST, "professor", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                            $desc = filter_input(INPUT_POST, "description", FILTER_SANITIZE_SPECIAL_CHARS);
                            // check if course ready exits
                            $sql = $conn->prepare("SELECT * FROM courses WHERE course_code =?");
                            $sql->bind_param("s", $course_code);
                            $sql->execute();
                            $result = $sql->get_result();
                            if($result->num_rows > 0){
                                alert("Course code already exists");
                                return;
                            }
                            // Check if the connection is established
                            if(!$conn) {
                                die("Database connection error");
                            }
                            $sql = $conn->prepare("INSERT INTO courses(course_code, course_name, course_credit, course_dec, dept_id) VALUES (?, ?, ?, ?, ?)");
                            $sql->bind_param("ssisi", $course_code, $course_name, $credit, $desc, $department_id);

                            if(!$sql->execute()){
                                die("Error executing SQL statement: ".$sql->error);
                            } else {
                                $course_id = $sql->insert_id;
                            }

                            foreach($professors as $professor){
                                $professor = filter_var($professor, FILTER_SANITIZE_NUMBER_INT);
                                if(!$professor) continue;

                                $sql = $conn->prepare("INSERT INTO course_professors (course_id, prof_id) VALUES (?, ?)");
                                $sql->bind_param("ii", $course_id, $professor);

                                if(!$sql->execute()){
                                    die("Error executing SQL statement: ".$sql->error);
                                }
                            }
                            alert( "Course and professors inserted successfully");
                            // reset all fields when add success
                            $course_code = $course_name = $credit = $department_id = "";
                            $professors = array();
                        }
                    ?>
               
                    <div class=" bg-gray-900 rounded-lg p-4 h-full ">
                        <!-- header  -->
                        <div class="w-full border-b border-gray-600 pb-3 mb-10 flex justify-between items-center">
                            <div class="flex items-center gap-2">
                                <h2 class="text-blue-500 text-xl ">Add New Course</h2>
                                <ion-icon name="pencil-outline" class="text-gray-300 text-xl"></ion-icon>
                            </div>
                            <div>
                                <button type="button" id="clear-btn-fields" class="text-white hover:text-red-500 active:text-white  bg-red-500 hover:bg-transparent active:bg-red-500 border-2 border-red-500 flex items-center gap-2 px-5 py-1 rounded-md duration-300"> 
                                    <ion-icon name="trash-bin-outline"></ion-icon>
                                    <span>Clear</span>
                                </button>
                            </div>
                        </div>
                        <?php
                            $sql = "SELECT * FROM courses WHERE course_id = $id";
                            $result = mysqli_query($conn, $sql);
                            $row = $result->fetch_assoc();
                            $dec =  $row['course_dec'];
                        ?>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"  method="post" enctype="multipart/form-data" id="course-form">
                            <div class="grid grid-cols-2 gap-2 mt-4">
                                <div>
                                    <label for="course_code" class="text-blue-500">Course Code *</label><br>
                                    <input type="text" value="<?php echo isset($row['course_code']) ? $row['course_code'] : '' ?>"  name="course_code" id="course_code" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                                </div>  
                                <div class="relative">
                                    <label for="course_name" class="text-blue-500">Course name *</label><br>
                                    <input type="text"  value="<?php echo isset($row['course_name']) ? $row['course_name'] : '' ?>"  name="course_name" id="course_name" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400 peer" >
                                    <button type="button" id="dropdown-course" class="text-gray-600 hover:text-white absolute  top-7 right-1 text-base  h-10 w-10 peer-focus:border-blue-500"><ion-icon name="chevron-down-outline"></ion-icon></button>
                                    <ul  id="option-dropdown" class="absolute top-full left-0 bg-gray-700 w-full h-0  duration-500 ease-out rounded-md overflow-auto">
                                    </ul>
                                </div>
                                <div>
                                    <label for="credit" class="text-blue-500">Credit *</label><br>
                                    <input type="number" min="1" value="<?php echo isset($row['course_credit']) ? $row['course_credit'] : '' ?>"  name="credit" id="credit"  class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                                </div>
                                <div >
                                    <label for="department" class="text-blue-500">Department *</label><br>
                                    <select id="department" name="department"  class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <?php
                                            $sql = $conn->prepare("SELECT dept_id, dept_name FROM departments");
                                            if(!$sql->execute()){
                                                die("Error executing sql statement". $sql->error);
                                            }else{
                                                $result = $sql->get_result();
                                                $num = $result->num_rows;
                                                if($num > 0){
                                                    $rows = $result->fetch_all(MYSQLI_ASSOC);
                                                    foreach($rows as $row){
                                                        $selected = isset($row['dept_id']) == $row['dept_id'] ? "selected" : '';
                                                        echo "<option value='{$row['dept_id']}' {$selected}>{$row['dept_name']}</option>";
                                                    }
                                                }else{
                                                    echo "<option>No record!</option>";
                                                }
                                                
                                                
                                            }
                                        ?>
                                    </select>
                                </div>  
                                <div class="">
                                    <label for="professor" class="text-blue-500">Professor *</label><br>
                                    <select name="professor[]" id="professor" multiple class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full h-40 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 overflow-hidden">
                                        <optgroup   value="<?php echo isset($professor) ? $professor : '' ?>" class="bg-transparent border-2 border-gray-700 rounded-md px-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                                            <?php
                                                $sql = $conn->prepare("SELECT prof_id, first_name, last_name FROM professors");
                                                if(!$sql->execute()){
                                                    die("Error executing sql statement". $sql->error);
                                                }else{
                                                    $result = $sql->get_result();
                                                    $num = $result->num_rows;
                                                if($num > 0){
                                                    $rows = $result->fetch_all(MYSQLI_ASSOC);
                                                    foreach($rows as $row){
                                                    echo "<option value='{$row['prof_id']}' class='text-base'>{$row['first_name']} {$row['last_name']}</option>";
                                                    }
                                                }else{
                                                    echo "<option>No record!</option>";
                                                }
                                                }
                                            ?>
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="">
                                <label for="description" class="text-blue-500">Description *</label><br>
                                    <textarea rows="6" name="description" id="description"   class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400 " >
                                        <?php echo isset($dec)? $dec : '' ?>
                                    </textarea>
                            </div>
                                <div>
                                    <button type="submit" name="save" class="uppercase text-sm font-medium text-white bg-blue-500 border-2 border-blue-500 duration-300 px-8 py-2 rounded-md hover:bg-transparent active:bg-gray-900 focus:ring-2 ring-gray-900/30 hover:text-blue-500">
                                        <ion-icon name="bookmark"></ion-icon>    
                                        save
                                    </button>
                                    <a href="./course.php" class="uppercase text-sm font-medium text-red-500 hover:text-white border-2 border-red-500 bg-transparent px-8 py-2 rounded-md hover:bg-red-500 active:bg-red-600 focus:ring-2 ring-red-500/30 duration-300 ">
                                        Exit
                                    </a>
                                </div>
                            </div>
                            </div>
                    </form>
                    </div>
                 </div>
            </main>
        </div>
    </div>
    <?php include '../includes/footer.php'?>
    <script type="text/javascript">
        const btnDropdown = document.getElementById('dropdown-course');
        const option = document.getElementById('option-dropdown');
        const courseName = document.getElementById('course_name');

        const optionCourses = [
            {
                text: 'Introduction to Business',
            },
            {
                text: 'Business Management and Leadership',
            },
            {
                text: 'Entrepreneurship',
            },
            {
                text: 'Marketing and Sales',
            },
            {
                text: 'Financial Management',
            },
            {
                text: 'Human Resource Management',
            },
            {
                text: 'Operations Management',
            },
            {
                text: 'Business Strategy',
            },
            {
                text: 'Business Law and Ethics',
            },
            {
                text: 'Project Management',
            },
            {
                text: 'Supply Chain Management',
            },
            {
                text: 'E-commerce and Digital Marketing',
            },
            {
                text: 'Business Communication',
            },
            {
                text: 'International Business',
            },
            {
                text: 'Innovation and Change Management',
            },
            {
                text: 'DBMS',
            },
            {
                text: 'Front End Development',
            },
            {
                text: 'Back End Development',
            },
            {
                text: 'Full Stack Development',
            },
            {
                text: 'Computer Networking',
            },
            {
                text: 'Cybersecurity',
            },
            {
                text: 'Software Engineering',
            },
            {
                text: 'Mobile Application Development',
            },
            {
                text: 'Web Application Development',
            },
            {
                text: 'Cloud Computing',
            },
            {
                text: 'Data Science and Analytics',
            },
            {
                text: 'Artificial Intelligence and Machine Learning',
            },
            {
                text: 'Blockchain Technology',
            },
            {
                text: 'Internet of Things (IoT)',
            },
            {
                text: 'IT Project Management',
            },
            {
                text: 'Personal Application',
            },
            {
                text: 'Others',
            },
        ];

        btnDropdown.onclick = ()=>{
            option.classList.toggle('active')
        }
        optionCourses.forEach((item)=>{
            let li = document.createElement('li');
            li.textContent = item.text;
            li.classList.add('text-gray-300', 'px-2', 'hover:bg-white/20', 'duration-300', 'cursor-pointer');
            option.appendChild(li);
            li.onclick = ()=>{
                courseName.value = item.text;
                option.classList.remove('active')
            }
        })
        // clear fields 
        const clearFieldsBtn = document.getElementById('clear-btn-fields');
        clearFieldsBtn.onclick = ()=>{
            document.getElementById('course-form').reset();
            courseName.value = '';
        }

    </script>
</body>
</html>