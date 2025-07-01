// Loading Screen
document.addEventListener('DOMContentLoaded', () => {
    const loadingScreen = document.getElementById('loading-screen');
    const body = document.body;
    if (loadingScreen) {
        body.style.overflow = 'hidden';
        setTimeout(() => {
            loadingScreen.classList.add('fade-out');
            body.style.overflow = 'auto';
        }, 2000);
    }
});


// Navbar
try {
    const menuItems = document.querySelectorAll('nav ul li a');

    // jika nav items diclick
    menuItems.forEach(item => {
        item.addEventListener('click', function () {
            // Menghapus kelas "active" dari semua elemen menu
            menuItems.forEach(item => {
                item.classList.remove('active');
            });

            // Menambahkan kelas "active" pada elemen menu yang diklik
            this.classList.add('active');
        });

    });
} catch (error) {
    console.log("Navbar tidak ada.");
}



// Back to Top
// try {
//     const iconBackToTop = document.querySelector(".icon-back-to-top");

//     window.addEventListener("scroll", () => {
//         if (window.pageYOffset > 100) {
//             iconBackToTop.classList.add("active");
//         }
//         else {
//             iconBackToTop.classList.remove("active");
//         }
//     })
// } catch (error) {
//     console.log("Back to Top tidak ada.");
// }
// Back to Top End
