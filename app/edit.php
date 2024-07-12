<?php
include('../db/database.php'); 

$id = $_GET['id'];

function alert($message) {
    echo "<script>alert('$message');</script>";
}

if (isset($_POST['save'])) {
    $fname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
    $lname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $dob = filter_input(INPUT_POST, "dob", FILTER_SANITIZE_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_SPECIAL_CHARS);
    $position = filter_input(INPUT_POST, "position", FILTER_SANITIZE_SPECIAL_CHARS);
    $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);
    $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_SPECIAL_CHARS);
    $file_name = $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];
    $folder = '../img/' . $file_name;

    // Prepare SQL statement with placeholders
    $sql = "UPDATE `employees` SET 
                `fname`=?, 
                `lname`=?, 
                `gender`=?, 
                `dob`=?, 
                `position`=?, 
                `phone`=?, 
                `email`=?, 
                `address`=?, 
                `photo`=? 
            WHERE id=? 
            LIMIT 1";

    // Initialize prepared statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("sssssssssi", $fname, $lname, $gender, $dob, $position, $phone, $email, $address, $file_name, $id);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Move uploaded file
            if (move_uploaded_file($tempName, $folder))
            {
                header("Location: employees.php");
                exit();
            }
        } else {
            alert("Failed to update employee information.");
            error_log("Error executing statement: " . $stmt->error);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
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
                    $sql = "SELECT * FROM employees WHERE id= $id LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row = $result->fetch_assoc();
                    $dob = $row['dob'];

                ?>
                <div class=" bg-gray-900 rounded-lg p-4 h-full ">
                   <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>"  method="post" enctype="multipart/form-data" class="">
                        <div class="w-full flex flex-col items-center justify-center ">
                            <div class="w-24 h-24 object-cover rounded-full overflow-hidden border-2 border-gray-600">
                                <img src="../img/<?php echo $row['photo']? $row['photo'] : "user-profile.jpg" ?>" id="imgDisplay" class="h-full w-full object-cover hover:scale-[1.1] duration-300" >
                            </div>
                            <div class="relative ">
                                <label class="bg-white w-6 h-6 rounded-full flex justify-center items-center absolute right-0 -translate-y-6 border-2 border-gray-500" for="image"><ion-icon name="camera"></ion-icon></label>
                                <input  class=" w-72 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 hidden" name="image" id="image" type="file" multiple>
                                <p class="block mb-2 text-sm font-medium text-gray-300">Upload Photo</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 mt-4">
                            <div>
                                <label for="fname" class="text-blue-500">First Name *</label><br>
                                <input type="text" value="<?php echo $row['fname']?> " name="fname" id="fname" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                            </div>
                            <div>
                                <label for="lname" class="text-blue-500">Last Name *</label><br>
                                <input type="text" value="<?php echo $row['lname']?> "  name="lname" id="lname" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                            </div>
                            <div class="col-span-2">
                                <label for="address" class="text-blue-500">Address *</label><br>
                                <input type="text"  value="<?php echo $row['address']?> " name="address" id="address" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                            </div>
                            <div >
                                <label for="dob" class="text-blue-500">Date of Birth *</label><br>
                                <input type="date"  <?php echo $dob; ?> name="dob" id="dob" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                            </div>
                            <div >
                                <label for="position" class="text-blue-500">Position Birth *</label><br>
                                <input type="text"  value="<?php echo $row['position']?> " name="position" id="position" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                            </div>
                            <div class="col-span-2">
                                <label for="email" class="text-blue-500">Email *</label><br>
                                <input type="email"  value="<?php echo $row['email']?> " name="email" id="email" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                            </div>
                            <div>
                                <label for="phone" class="text-blue-500">Phone *</label><br>
                                <input type="text" value="<?php echo $row['phone']?> " name="phone" id="phone" class="bg-transparent border-2 border-gray-700 rounded-md px-2 py-2 w-full outline-none focus:border-blue-500 duration-300 text-gray-400" >
                            </div>
                            <div>
                            <label for="gender" class="text-blue-500">Gender *</label>
                            <div class="flex items-center gap-2">
                                    <label
                                        class="has-[:checked]:bg-gray-700 has-[:checked]:text-indigo-900 has-[:checked]:ring-indigo-200 has-[:checked]:ring-2 cursor-pointer bg-white/10 border-2 border-gray-700 hover:bg-white/20 w-full h-10 px-2 rounded-md flex justify-between items-center shadow"
                                    >
                                        <div class="flex items-center gap-2 text-white">
                                            <span class="flex text-base"><ion-icon name="male"></ion-icon></span>
                                            <h2 class="text-base">Male</h2>
                                        </div>
                                        <input
                                        type="radio"
                                        name="gender"
                                        value="male"
                                        <?php if($row['gender']=="male"){echo "checked";}?>
                                        class="checked:border-indigo-500 h-4 w-4 "
                                        />
                                    </label>
                                    <label
                                        class="has-[:checked]:bg-gray-700 has-[:checked]:text-indigo-900 has-[:checked]:ring-indigo-200 has-[:checked]:ring-2 cursor-pointer bg-white/10 border-2 border-gray-700 hover:bg-white/20 w-full h-10 px-2 rounded-md flex justify-between items-center shadow"
                                    >
                                        <div class="flex items-center gap-2">
                                            <span class="flex text-base text-white"><ion-icon name="female"></ion-icon></span>
                                            <h2 class="text-base text-white">Female</h2>
                                        </div>
                                        <input
                                        type="radio"    
                                        name="gender"
                                        value="female"
                                        <?php if($row['gender']=="female"){echo "checked";}?>
                                        class="checked:border-indigo-500 h-4 w-4 "
                                        
                                        />
                                    </label>
                                </div>
                                </div>
                            <div class="flex items-center gap-2 mt-3">
                            <button type="submit" name="save" class="uppercase text-sm font-medium text-white bg-blue-500 border-2 border-blue-500 duration-300 px-8 py-2 rounded-md hover:bg-transparent active:bg-gray-900 focus:ring-2 ring-gray-900/30 hover:text-blue-500">
                                <ion-icon name="bookmark"></ion-icon>    
                                save
                            </button>
                            <a href="./employees.php" class="uppercase text-sm font-medium text-red-500 hover:text-white border-2 border-red-500 bg-transparent px-8 py-2 rounded-md hover:bg-red-500 active:bg-red-600 focus:ring-2 ring-red-500/30 duration-300 ">
                                Cancel
                            </a>
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