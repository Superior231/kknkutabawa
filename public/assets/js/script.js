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
