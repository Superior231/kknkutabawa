<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ url('assets/js/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- PWA  -->
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if ("serviceWorker" in navigator) {
        navigator.serviceWorker.register("/sw.js").then(
            (registration) => {
                console.log("Service worker registration succeeded");
            },
            (error) => {
                console.error(`Service worker registration failed`);
            },
        );
    } else {
        console.error("Service workers are not supported.");
    }
</script>

<script>
    window.onload = function () {
        if (!localStorage.getItem('visited')) {
            Swal.fire({
                icon: 'info',
                title: 'Information',
                text: 'Situs ini dibuat sebagai dokumentasi pribadi kegiatan KKN Desa Kutabawa 2025 oleh mahasiswa Universitas Pancasakti Tegal. Logo Universitas dan logo Kampus Merdeka digunakan sebagai bagian dari identitas kegiatan dan bukan merupakan pengesahan institusi resmi.',
                confirmButtonText: 'Mengerti',
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                customClass: {
                    popup: 'sw-popup',
                    title: 'text-color',
                    htmlContainer: 'sw-text',
                    icon: 'sw-icon border-primary text-primary',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-primary border-0 shadow-none',
                },
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Hanya simpan ke localStorage jika user klik OK
                    localStorage.setItem('visited', 'true');
                }
            });
        }
    };
</script>

@stack('scripts')