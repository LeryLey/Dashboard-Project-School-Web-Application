<div class="bg-primary h-full py-10 pr-2 relative ">
    <div  class="flex items-center justify-between px-4">
        <div class="flex items-center gap-2">
            <div>
                <img src="../img/<?php echo isset($_SESSION['PHOTO']) ? $_SESSION['PHOTO'] : 'user-profile.jpg' ?>"  class="w-12 h-12 rounded-full object-cover">
            </div>
            <div class="hidden md:flex flex-col">
                <h1 class="text-gray-200 text-xl capitalize">
                    <?php echo isset($_SESSION['USERNAME']) ? $_SESSION['USERNAME']  : ''?>
                </h1>
                <p class="text-gray-500 text-sm">
                    <?php echo isset($_SESSION['ROLE_ID'])? $_SESSION['ROLE_ID']  : ''?>
                </p>
            </div>
        </div>
        <div class="text-gray-400  relative">
            <ion-icon name="ellipsis-vertical" id="btnOption" class="hover:bg-white/10 p-2 rounded-full cursor-pointer"></ion-icon>
            <div id="option" class="absolute  right-0 top-full  w-24 h-auto rounded-md bg-black p-1 opacity-0 duration-300">
                <a href="index.php" class="flex items-center text-blue-500 gap-1 rounded px-1 hover:bg-white/10">
                    Edit
                </a>
                <a href="logout.php" 
                onclick="return confirm('Do you want to exit?')"
                class="flex  items-center text-red-500 gap-1 rounded px-1 hover:bg-white/10">
                    Log out
                </a>
            </div>
        </div>
    </div>
    <ul class="mt-10 space-y-1">
        <a href="dashboard.php" class="flex items-center gap-2 text-base hover:bg-black/70 px-2 py-1 duration-300 rounded-r-full">
            <ion-icon name="timer" class="text-purple-700 bg-white/10 rounded-full p-2"></ion-icon>
            <span id="linkName"  class="text-gray-300">Dashboard</span>
        </a>
        <a href="chart.php" class="flex items-center gap-2 text-base hover:bg-black/70 px-2 py-1 duration-300 rounded-r-full">
            <ion-icon name="pie-chart" class="text-green-500 bg-white/10 rounded-full p-2"></ion-icon>
            <span id="linkName" class="text-gray-300">Chart</span>
        </a>
        <a href="employees.php" class="flex items-center gap-2 text-base hover:bg-black/70 px-2 py-1 duration-300 rounded-r-full">
            <ion-icon name="person" class="text-orange-500 bg-white/10 rounded-full p-2"></ion-icon>
            <span id="linkName" class="text-gray-300">Employee</span>
        </a>
        <a href="user.php" class="flex items-center gap-2 text-base hover:bg-black/70 px-2 py-1 duration-300 rounded-r-full">
            <ion-icon name="shield-checkmark" class="text-blue-500 bg-white/10 rounded-full p-2"></ion-icon>
            <span id="linkName"  class="text-gray-300">Mange User</span>
        </a>
    </ul>
</div>
