const toggleBtn = document.getElementsByClassName("sidebar-toggle")[0];
if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
        alert("I got clicked");
    });
}