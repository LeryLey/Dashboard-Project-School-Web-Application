<?php
    session_start();
    include("../db/database.php");
    $response = array();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("SELECT id, username, email, role_id, photo, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if(password_verify($password, $user["password"])){
                $_SESSION["USERNAME"] = $user["username"];
                $_SESSION["USER_ID"] = $user["id"];
                $_SESSION["PHOTO"] = $user["photo"];
                $_SESSION["ROLE_ID"] = $user["role_id"];
                $response["status"] = "success";
                $response["message"] = "Login successful";
            }else{
                $response["status"] = "error";
                $response["message"] = "Invalid username or password";
            }
        }else{
            $response["status"] = "Error";
            $response["message"] = "Email and password not found";
        }
        $stmt->close();
    }else{
        $response["status"] = "error";
        $response["message"] = "Invalid request";
    }
    echo json_encode($response);
?>
