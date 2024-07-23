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
                    <div class="relative">
                        <input type="text" id="course" class="w-60 bg-transparent outline-none h-7 text-gray-400 rounded-md">
                        <button type="button" id="btnDropdown" class="text-gray-600 absolute -translate-x-5 top-1"><ion-icon name="chevron-down-outline"></ion-icon></button>
                        <ul id="options" class="absolute top-full left-0 bg-white/10 w-full h-0 duration-500 ease-out rounded-b-md overflow-hidden">
                        </ul>
                    </div>
                </div>  
            </main>
        </div>
    </div>
    <?php  include("../includes/footer.php")?>
    <script>
        const btnDropdown = document.getElementById('btnDropdown');
        const option = document.getElementById('options');
        const course = document.getElementById('course');

        const options = [
           {value: 'Web Application' },
           {value: 'Mobile Application' },
           {value: 'Data Science' },
           {value: 'Cyber Security' }
        ];

        options.forEach((item)=>{
            const li = document.createElement('li');
            li.textContent = item.value;
            li.classList.add('text-gray-300', 'px-2', 'hover:bg-white/20', 'duration-300');

            li.addEventListener('click', () => {
                course.value = item.value;
                option.classList.remove('h-0');
            });

            option.appendChild(li);
        })
        btnDropdown.addEventListener('click', () => {
            option.classList.toggle('h-auto');
        });
     

    </script>
</body>
</html>