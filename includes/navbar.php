<nav class="relative w-full h-auto py-3 bg-primary flex items-center justify-between">
    <div class="flex items-center gap-3">
        <button type="button" id="sidebarBtn" class="hover:bg-white/10 rounded-full w-10 h-10 flex items-center justify-center text-gray-600 text-2xl hover:text-white duration-300">
            <ion-icon name="menu"></ion-icon>
        </button>
        <input type="search" placeholder="Search Products..." name="search" id="search" class="bg-transparent border-2 border-gray-700 rounded hidden lg:flex lg:w-60 xl:w-80 px-2 py-1 placeholder:text-gray-500 placeholder:text-sm  text-gray-400 outline-none focus:border-blue-500 duration-300">
    </div>
    <div class="flex items-center gap-10">
        <div>
            <button type="button" class="flex gap-2 hover:text-white items-center text-gray-400">
                <ion-icon name="add" class="text-xl"></ion-icon>
                Create New Project
            </button>
        </div>
        <div class="flex gap-1">
            <button type="button" class="text-white text-xl hover:bg-white/10 w-10 h-10 rounded-full flex items-center justify-center">
                <ion-icon name="grid"></ion-icon>
            </button>
            <!-- mail  -->
            <button type="button" class="text-white text-xl hover:bg-white/10 w-10 h-10 rounded-full flex items-center justify-center">
                <ion-icon name="mail"></ion-icon>
            </button>
            <!-- notification  -->
            <div id="open-notification" type="button" class="relative text-white text-xl hover:bg-white/10 focus:bg-white/10 w-10 h-10 rounded-full flex justify-center items-center cursor-pointer group">
                <div class="relative ">
                    <span class="absolute -right-2 -top-1 flex h-3 w-3 ">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
                    </span>
                    <ion-icon name="notifications"></ion-icon>
                </div>
                <div id="notification" class="absolute w-80 right-0 top-full bg-gray-800 rounded-md p-4 z-10 pointer-events-none opacity-0 duration-500 ease-out">
                    <span id="close-notification">
                        <ion-icon name="add-outline"  class="absolute right-2 top-2 rotate-45 text-xl text-gray-400 hover:text-white"></ion-icon>
                    </span>
                    <h2 class="text-[0.9em] text-gray-200 text-left">Notification</h2>
                    <p class="text-base text-left text-gray-400 my-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Et, molestiae.</p>
                </div>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <img src="../img/<?php echo isset($_SESSION['PHOTO']) ? $_SESSION['PHOTO'] : 'user-profile.jpg' ?>"class="w-10 h-10 object-cover rounded-full" >
            <button type="button" class="flex items-center text-gray-400 hover:text-white duration-300">
                <h1 class="text-base capitalize "><?php echo isset($_SESSION['USERNAME']) ? $_SESSION['USERNAME']  : ''?></h1>
                <ion-icon name="caret-down"></ion-icon>
            </button>
        </div>
    </div>
</nav>