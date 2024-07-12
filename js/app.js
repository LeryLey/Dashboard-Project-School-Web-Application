
// notification
const notification = document.getElementById("notification");
const close = document.getElementById("close-notification");
const open = document.getElementById("open-notification");
open.onclick = () => {
  notification.classList.toggle("pointer-events-auto");
  notification.classList.toggle("opacity-100");
  notification.classList.toggle("translate-y-2");
};

// edit and logout
document.getElementById("btnOption").onclick = () => {
  document.getElementById("option").classList.toggle("opacity-100");
  document.getElementById("option").classList.toggle("translate-y-2");
};

// open projects
const containerProjects = document.getElementById("container-projects");
const projects = [
  {
    id: 1,
    icon: '<span class="text-xl text-white bg-blue-500 w-10 h-10 rounded flex justify-center items-center"><ion-icon name="document-text"></ion-icon></span>',
    title: "Project 1",
    description: "Lorem ipsum dolor.",
    finished: "14 minutes ago",
    status: "35 Tasks, 5 issues",
  },
  {
    id: 2,
    icon: '<span class="text-xl text-white bg-purple-500 w-10 h-10 rounded flex justify-center items-center"><ion-icon name="cloud-download"></ion-icon></span>',
    title: "Project 2",
    description: "Lorem ipsum dolor.",
    finished: "20 minutes ago",
    status: "28 Tasks, 2 issues",
  },
  {
    id: 3,
    icon: '<span class="text-xl text-white bg-orange-500 w-10 h-10 rounded flex justify-center items-center"><ion-icon name="time"></ion-icon></span>',
    title: "Project 3",
    description: "Lorem ipsum dolor.",
    finished: "1 hour ago",
    status: "15 Tasks, 1 issue",
  },
  {
    id: 4,
    icon: '<span class="text-xl text-white bg-red-500 w-10 h-10 rounded flex justify-center items-center"><ion-icon name="mail"></ion-icon></span>',
    title: "Project 4",
    description: "Lorem ipsum dolor.",
    finished: "2 hours ago",
    status: "10 Tasks, 0 issues",
  },
];
projects.forEach((item) => {
  const { icon, title, description, finished, status } = item;
  containerProjects.innerHTML += `
                <div class="flex justify-between border-b-2 border-gray-800 py-1">
                    <div class="flex items-center gap-2">
                        ${icon}
                        <div>
                            <h2 class="text-xl text-gray-200">${title}</h2>
                            <p class="text-base text-gray-500">${description}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">${finished}</p>
                        <p class="text-sm text-gray-500">${status}</p>
                    </div>
                </div>
            `;
});
const cards = document.getElementById("card-items");
const items = [
  {
    id: 1,
    price: "14.5",
    percentage: "<p class='text-green-500'>+3.5 %</p>",
    icon: "<div class='text-xl text-green-500 flex items-center justify-center w-10 h-10 rounded bg-green-500/10'><ion-icon name='trending-up'></ion-icon></div>",
    txt: "Item 1",
  },
  {
    id: 2,
    price: "19.5",
    percentage: "<p class='text-green-500'>+5.5 %</p>",
    icon: "<div class='text-xl text-green-500 flex items-center justify-center w-10 h-10 rounded bg-green-500/10'><ion-icon name='trending-up'></ion-icon></div>",
    txt: "Item 2",
  },
  {
    id: 3,
    price: "12.5",
    percentage: "<p class='text-red-500'>-2.5 %</p>",
    icon: "<div class='text-xl text-red-500 flex items-center justify-center w-10 h-10 rounded bg-red-500/10'><ion-icon name='trending-down'></ion-icon></div>",
    txt: "Item 3",
  },
  {
    id: 4,
    price: "17.5",
    percentage: "<p class='text-green-500'>+4.5 %</p>",
    icon: "<div class='text-xl text-green-500 flex items-center justify-center w-10 h-10 rounded bg-green-500/10'><ion-icon name='trending-up'></ion-icon></div>",
    txt: "Item 4",
  },
];
items.forEach((item) => {
  cards.innerHTML += `
      <article class="flex justify-between gap-4 bg-primary w-full h-auto py-6 px-4 rounded-md hover:bg-gray-800 duration-200 mb-4">
          <div>    
              <div class='flex items-center gap-1'>
                  <h2 class='text-white text-2xl'>$${item.price}</h2>
                  <span class='flex'>${item.percentage}</span>
              </div>
              <div>
                  <p class='text-gray-500'>
                      ${item.txt}
                  </p>
              </div>
          </div>
          <div>
              ${item.icon}
          </div>
      </article>
    `;
});
