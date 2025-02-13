const toggleSidebarButton = document.getElementById('toggleSidebar');
const sidebar = document.querySelector('.sidebar');
const mainContent = document.querySelector('.main-content');

toggleSidebarButton.addEventListener('click', () => {
    sidebar.classList.toggle('d-none');
    mainContent.classList.toggle('shift-left');
});


