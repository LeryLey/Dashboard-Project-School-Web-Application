<?php 
    include('../db/database.php'); 
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
            <main class="bg-black rounded-tl-md h-[89vh] p-4 overflow-auto ">
                <div class="h-full">
                <?php 
                    function alert($message){
                       echo "<script>alert('$message')</script>";
                    }
                    if(isset($_POST['save'])){
                        // select fields (photo, username, email, password, role id);
                        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
                        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
                        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
                        $hash = password_hash($password, PASSWORD_BCRYPT);
                        $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
                        $role_id = $_POST["role_id"];                        // check if empty fields
                        $dec = filter_input(INPUT_POST, "dec", FILTER_SANITIZE_SPECIAL_CHARS);
                        if(empty($username) || empty($email) || empty($password)){
                            echo alert('All fields are required');
                        }else{
                            // insert data by prepare statement
                            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role_id, phone, photo) VALUES (?,?,?,?,?,?)");
                            $stmt ->bind_param("ssssss", $username, $email, $hash, $role_id, $phone, $file_name );
                            $stmt ->get_result();

                            // upload file image
                            $file_name = $_FILES['image']['name'];
                            $tempName = $_FILES['image']['tmp_name'];
                            $folder = '../img/'.$file_name;

                            // check file size
                            if($_FILES['image']['size'] > 3000000){
                                alert("File size is too large! Please choose file size less than 3MB");
                            }

                            //allow file extension
                            $allow_type = array('jpg', 'jpeg', 'png');
                            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                            //check file extension
                            if(!in_array($ext, $allow_type)){
                                alert("Invalid file type! Please choose file is (jpg, png or jpeg)");
                            }else{
                                // move file to folder
                                move_uploaded_file($tempName, $folder);
                                if($stmt->execute()){
                                    alert("Added user successfully.");
                                    
                                    // reset fields
                                    $username = "";
                                    $email = "";
                                    $password = "";
                                    $phone = "";
                                    $role_id = "";
                                    $dec = "";
                                    
                                }else{
                                    die(mysqli_connect_error());
                                }
                            }

                            
                        }
                        

                        
                    }

                ?>
               
                <div class=" bg-gray-900 rounded-lg p-4 h-full ">
                   <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>"  method="post" enctype="multipart/form-data" class="">
                        <div class="w-full flex flex-col items-center justify-center ">
                            <div class="w-24 h-24 object-cover rounded-full overflow-hidden border-2 border-gray-600">
                                <img src="../img/<?php echo isset($file_name) ? $file_name : 'user-profile.jpg' ?>" id="imgDisplay" class="h-full w-full object-cover hover:scale-[1.1] duration-300" >
                            </div>
                            <div class="relative ">
                                <label class="bg-white w-6 h-6 rounded-full flex justify-center items-center absolute right-0 -translate-y-6 border-2 border-gray-500" for="image"><ion-icon name="camera"></ion-icon></label>
                                <input  class="w-72 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 hidden" name="image" id="image" type="file" >
                                <p class="block mb-2 text-sm font-medium text-gray-300">Upload Photo</p>
                            </div>

                        </div>
                        <div class="grid grid-cols-2 gap-2 mt-4">
                            <div>
                                <label for="username" class="text-blue-500">Username *</label><br>
                                <input type="text" value="<?php echo isset($username) ? $username : '' ?>"  name="username" id="username" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                            </div>
                            <div>
                                <label for="email" class="text-blue-500">Email*</label><br>
                                <input type="text" value="<?php echo isset($email) ? $email : '' ?>"  name="email" id="email" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                            </div>
                            <div class="col-span-2">
                                <label for="password" class="text-blue-500">Password *</label><br>
                                <input type="password" value="<?php echo isset($password) ? $password : '' ?>"  name="password" id="password" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                            </div>
                            
                            <div >
                                <label for="role_id" class="text-blue-500">Role *</label><br>
                                <select id="role_id" name="role_id"  class="bg-transparent text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <?php
                                        // select role id from database 
                                        $sql = $conn->prepare("SELECT id, role_name FROM roles ORDER BY role_name DESC");
                                        if (!$sql->execute()) {
                                            die("Error execute: " . $sql->error);
                                        }
                                        $result = $sql->get_result();
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['role_name']) . "</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>  
                            <div>
                                <label for="phone" class="text-blue-500">Phone *</label><br>
                                <input type="text" value="<?php echo isset($phone) ? $phone : '' ?>"  name="phone" id="phone" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                            </div>
                            <div class="col-span-2">
                                <label for="description" class="text-blue-500">Description *</label><br>
                                <textarea rows="4" value="<?php echo isset($dec) ? $dec : '' ?>" name="description" id="description" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >

                                </textarea>
                            </div>
                            <div>
                                <button type="submit" name="save" class="uppercase text-sm font-medium text-white bg-blue-500 border-2 border-blue-500 duration-300 px-8 py-2 rounded-md hover:bg-transparent active:bg-gray-900 focus:ring-2 ring-gray-900/30 hover:text-blue-500">
                                    <ion-icon name="bookmark"></ion-icon>    
                                    save
                                </button>
                                <a href="./user.php" class="uppercase text-sm font-medium text-red-500 hover:text-white border-2 border-red-500 bg-transparent px-8 py-2 rounded-md hover:bg-red-500 active:bg-red-600 focus:ring-2 ring-red-500/30 duration-300 ">
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
    <?php  include("../includes/footer.php")?>
    <script>
        document.getElementById("image").addEventListener("change",function(event){
        const file = event.target.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(e){
            const imgElement =document.getElementById("imgDisplay");
            imgElement.src = e.target.result;
            imgElement.style.display = "block";
            }
            reader.readAsDataURL(file);
        }
        })
        
    </script>
</body>
</html>