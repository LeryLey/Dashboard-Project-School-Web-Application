<?php
include("../db/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("../includes/head.php") ?>
    <title>Login | Admin</title>
</head>
<body class="flex min-h-screen items-center bg-gray-900">
    <div class="mx-auto">
        <div id="container-form"
        class="w-80 rounded-lg h-auto p-6 bg-gray-800 shadow space-y-10 relative overflow-hidden">
            <div class="duration-500 ease-in-out ">
                <div class="flex flex-col justify-center items-center space-y-2">
                    <ion-icon name="person" class="text-xl text-white bg-white/10 p-4 rounded-full"></ion-icon>
                    <h2 class="text-2xl font-medium text-gray-200">User Login</h2>
                    <p class="text-slate-500">Enter details below.</p>
                </div>
                <form id="loginForm" method="post" class="w-full mt-4 space-y-3">
                    <div class="relative">
                        <input
                            class="outline-none border-2 border-transparent focus:border-blue-500 duration-300 bg-gray-700 rounded-md px-2 py-1 w-full text-gray-300 "
                            placeholder="Email"
                            id="email"
                            name="email"
                            type="text"
                        />
                        <ion-icon name="person" class="absolute top-2 right-3 text-gray-400"></ion-icon>
                    </div>
                    <div class="relative">
                        <input
                            class="outline-none border-2 border-transparent focus:border-blue-500 duration-300 bg-gray-700 rounded-md px-2 py-1 w-full text-gray-300 "
                            placeholder="Password"
                            id="password"
                            name="password"
                            type="password"
                        />
                        <ion-icon name="lock-closed" class="absolute top-2 right-3 text-gray-400"></ion-icon>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input
                                class="mr-2 w-4 h-4"
                                id="show-password"
                                name="show-password"
                                type="checkbox"
                            />
                            <span class="text-slate-500">Show Password</span>
                        </div>
                        <a class="text-blue-500 font-medium hover:underline" href="update_password.php">Forgot Password</a>
                    </div>
                    <button
                        class="w-full justify-center py-1 bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-md text-white ring-2"
                        id="login"
                        name="login"
                        type="submit"
                    >
                        Login
                    </button>
                    <p class="flex justify-center space-x-1">
                        <span class="text-slate-300">Don't have an account?</span>
                        <button type="button" id="register" class="text-blue-500 hover:underline">Register</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#loginForm").on("submit", function (e) {
                e.preventDefault();
                var email = $("#email").val();
                var password = $("#password").val();
                if(email.trim() === "") {
                    alert("Please enter email");
                } else if(password.trim() === "") {
                    alert("Please enter password");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "../app/login_action.php",
                        dataType: "json",
                        data: $(this).serialize(),
                        beforeSend: function() {
                            // Optionally show a loading indicator
                        },
                        success: function(response) {
                            if (response.status == "success") {
                                window.location.href = "../app/dashboard.php";
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error: " + textStatus, errorThrown);
                            console.log(jqXHR.responseText); // Log the response for debugging
                        }
                    });
                }
            });

            // show password
            $("#show-password").on("change", function() {
                var passwordField = $("#password");
                if (this.checked) {
                    passwordField.attr("type", "text");
                } else {
                    passwordField.attr("type", "password");
                }
            });
        });
    </script>
</body>
</html>
