const sidebarToggle = document.querySelector('.sidebar-toggle')
const sidebarOverlay = document.querySelector('.sidebar-overlay')
const sidebarMenu = document.querySelector('.sidebar-menu')
const main = document.getElementById('main')

sidebarToggle.addEventListener('click', function (e) {
    e.preventDefault()
    main.classList.toggle('md:w-full')
    main.classList.toggle('md:ml-0')
    main.classList.toggle('md:w-[calc(100%-256px)]')
    main.classList.toggle('md:ml-64')
    sidebarOverlay.classList.toggle('hidden') // untuk mobile
    sidebarMenu.classList.toggle('md:translate-x-0')
    sidebarMenu.classList.toggle('md:-translate-x-full')
    sidebarMenu.classList.toggle('-translate-x-full') // untuk mobile
})
sidebarOverlay.addEventListener('click', function (e) {
    main.classList.toggle('md:w-full')
    main.classList.toggle('md:ml-0')
    main.classList.toggle('md:w-[calc(100%-256px)]')
    main.classList.toggle('md:ml-64')
    sidebarOverlay.classList.toggle('hidden') // untuk mobile
    sidebarMenu.classList.toggle('md:translate-x-0')
    sidebarMenu.classList.toggle('md:-translate-x-full')
    sidebarMenu.classList.toggle('-translate-x-full') // untuk mobile
})
document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
    item.addEventListener('click', function (e) {
        e.preventDefault()
        const parent = item.closest('.group')
        if (parent.classList.contains('selected')) {
            parent.classList.remove('selected')
        } else {
            document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (i) {
                i.closest('.group').classList.remove('selected')
            })
            parent.classList.add('selected')
        }
    })
})

// start: Popper
const popperInstance = {}
document.querySelectorAll('.dropdown').forEach(function(item, index){
    const popperId = 'popper-' + index
    const toggle = item.querySelector('.dropdown-toggle')
    const menu = item.querySelector('.dropdown-menu')
    const placement = item.getAttribute('data-placement') || 'bottom-end'

    menu.dataset.popperId = popperId
    popperInstance[popperId] = Popper.createPopper(toggle, menu, {
        modifiers: [
            {
                name: 'offset',
                options: {
                    offset: [0, 8],
                },
            },
            {
                name: 'preventOverflow',
                options: {
                    padding: 24,
                },
            },
        ],
        placement: placement
    });
})
document.addEventListener('click', function (e) {
    const toggle = e.target.closest('.dropdown-toggle')
    const menu = e.target.closest('.dropdown-menu')
    if (toggle) {
        const menuEl = toggle.closest('.dropdown').querySelector('.dropdown-menu')
        const popperId = menuEl.dataset.popperId
        if (menuEl.classList.contains('hidden')) {
            hideDropdown()
            menuEl.classList.remove('hidden')
            showPopper(popperId)

            if(typeof cari !== 'undefined'){ // kalau variabel cari ada
                cari.focus();
            }
        } else {
            menuEl.classList.add('hidden')
            hidePopper(popperId)
        }
    } else if (!menu) {
        hideDropdown()

        switch(location.pathname){
            case '/admin/perawat':
                if(statusCariPerawat){
                    statusCariPerawat = false;
                    location.reload();
                }
                break;
            case '/admin/dokter':
                if(statusCariDokter){
                    statusCariDokter = false;
                    location.reload();
                }
                break;
            case '/admin/jadwal-dokter':
                if(statusCariJadwalDokter){
                    statusCariJadwalDokter = false;
                    location.reload();
                }
                break;
            default:
                
                break;
        }
    }
})

function hideDropdown() {
    document.querySelectorAll('.dropdown-menu').forEach(function (item) {
        item.classList.add('hidden')
    })
}
function showPopper(popperId) {
    popperInstance[popperId].setOptions(function (options) {
        return {
            ...options,
            modifiers: [
                ...options.modifiers,
                { name: 'eventListeners', enabled: true },
            ],
        }
    });
    popperInstance[popperId].update();
}
function hidePopper(popperId) {
    popperInstance[popperId].setOptions(function (options) {
        return {
            ...options,
            modifiers: [
                ...options.modifiers,
                { name: 'eventListeners', enabled: false },
            ],
        }
    });
}
// end: Popper

/* const fullscreenButton = document.getElementById('fullscreen-button');

fullscreenButton.addEventListener('click', () => {
    if (document.fullscreenElement) {
        document.exitFullscreen();
    } else {
        document.documentElement.requestFullscreen();
    }
}); */

document.addEventListener('DOMContentLoaded', () => {
    var mainLink = document.getElementById('mom-link');
    var submenu = document.getElementById('child-link');

    if(mainLink){
        mainLink.addEventListener('click', function(event) {
            if (submenu.classList.contains('hidden')) {
                event.preventDefault(); // Prevent navigation only when opening the submenu
                submenu.classList.remove('hidden');
                submenu.classList.add('block');
            } else {
                submenu.classList.add('hidden');
                submenu.classList.remove('block');
            }
        });
    }

    // Close submenu when clicking outside
    if(mainLink){
        document.addEventListener('click', function(event) {
            var isClickInside = mainLink.contains(event.target) || submenu.contains(event.target);
            if (!isClickInside) {
                submenu.classList.add('hidden');
                submenu.classList.remove('block');
            }
        });
    }

    const successPhp = document.getElementById('success-php');
    if(successPhp){
        setTimeout(() => {
            successPhp.classList.add('hidden');
        }, 3000);
    }
    
    const failedPhp = document.getElementById('failed-php');
    if(failedPhp){
        setTimeout(() => {
            failedPhp.classList.add('hidden');
        }, 3000);
    }
});

function submitEditForm(event){
    event.preventDefault();

    Swal.fire({
        title: "Perubahan akan tersimpan!",
        text: "Tekan Ubah untuk menyimpan atau Batal untuk mengedit kembali",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#006633",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "Ubah",
        cancelButtonText: "Batal",
    }).then((result) => {
        if(result.isConfirmed){
            event.target.submit();
        }
    });
}

function hapusAkun(event){
    event.preventDefault();

    Swal.fire({
        title: "Hapus Akun",
        text: "Apakah anda yakin untuk menghapus akun anda?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if(result.isConfirmed){
            Swal.fire({
                title: "Hapus Akun",
                text: "Jika anda benar-benar ingin menghapus akun ini, maka anda tidak dapat lagi mengakses informasi dan fitur dalam website klinik RH61 ini, silahkan daftarkan diri anda lagi jika ingin melihat kembali informasi dan mengakses kembali website ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#D80032",
                cancelButtonColor: "#6b6767",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
            }).then((result) => {
                if(result.isConfirmed){
                    Swal.fire({
                        title: "Hapus Akun",
                        text: "Apakah anda benar-benar yakin?!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#D80032",
                        cancelButtonColor: "#6b6767",
                        confirmButtonText: "Hapus",
                        cancelButtonText: "Batal",
                    }).then((result) => {
                        if(result.isConfirmed){
                            event.target.submit();
                        }
                    });
                }
            });
        }
    });
}

function batalkanReservasi(event){
    event.preventDefault();

    Swal.fire({
        title: "Batalkan Reservasi",
        text: "Apakah anda yakin untuk membatalkan reservasi ini?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "Batalkan",
        cancelButtonText: "Batal",
    }).then((result) => {
        if(result.isConfirmed){
            Swal.fire({
                title: "Batalkan Reservasi",
                text: "Kalau anda membatalkannya, maka tidak akan bisa diubah kembali, apa anda yakin?!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#D80032",
                cancelButtonColor: "#6b6767",
                confirmButtonText: "Batalkan",
                cancelButtonText: "Batal",
            }).then((result) => {
                if(result.isConfirmed){
                    event.target.submit();
                }
            });
        }
    });
}

function hapusRekamMedis(event){
    event.preventDefault();

    Swal.fire({
        title: "Hapus Rekam Medis",
        text: "Apakah anda yakin untuk menghapus rekam medis ini?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if(result.isConfirmed){
            event.target.submit();
        }
    });
}

function banPasien(event){
    event.preventDefault();

    Swal.fire({
        title: "Ban Pasien",
        text: "Apakah anda yakin untuk memblokir pasien ini?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "Ban",
        cancelButtonText: "Batal",
    }).then((result) => {
        if(result.isConfirmed){
            event.target.submit();
        }
    });
}

function unbanPasien(event){
    event.preventDefault();

    Swal.fire({
        title: "Unban Pasien",
        text: "Apakah anda yakin untuk membuka blokir pasien ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#006633",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "Unban",
        cancelButtonText: "Batal",
    }).then((result) => {
        if(result.isConfirmed){
            event.target.submit();
        }
    });
}

function hapusDokter(event){
    event.preventDefault();

    Swal.fire({
        title: "Hapus Dokter",
        text: "Apakah anda yakin untuk menghapus dokter ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if(result.isConfirmed){
            Swal.fire({
                title: "Hapus Dokter",
                text: "Jika anda benar-benar ingin menghapus dokter ini, maka dokter tersebut tidak dapat dikembalikan jika sudah dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#D80032",
                cancelButtonColor: "#6b6767",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
            }).then((result) => {
                if(result.isConfirmed){
                    Swal.fire({
                        title: "Hapus Dokter",
                        text: "Apakah anda benar-benar yakin?!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#D80032",
                        cancelButtonColor: "#6b6767",
                        confirmButtonText: "Hapus",
                        cancelButtonText: "Batal",
                    }).then((result) => {
                        if(result.isConfirmed){
                            event.target.submit();
                        }
                    });
                }
            });
        }
    });
}

function hapusJadwalDokter(event){
    event.preventDefault();

    Swal.fire({
        title: "Hapus Jadwal Dokter",
        text: "Apakah anda yakin untuk menghapus jadwal dokter ini?!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if(result.isConfirmed){
            event.target.submit();
        }
    });
}

function hapusPerawat(event){
    event.preventDefault();

    Swal.fire({
        title: "Hapus Perawat",
        text: "Apakah anda yakin untuk menghapus perawat ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#D80032",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal",
    }).then((result) => {
        if(result.isConfirmed){
            Swal.fire({
                title: "Hapus Perawat",
                text: "Jika anda benar-benar ingin menghapus perawat ini, maka perawat tersebut tidak dapat dikembalikan jika sudah dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#D80032",
                cancelButtonColor: "#6b6767",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
            }).then((result) => {
                if(result.isConfirmed){
                    Swal.fire({
                        title: "Hapus Perawat",
                        text: "Apakah anda benar-benar yakin?!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#D80032",
                        cancelButtonColor: "#6b6767",
                        confirmButtonText: "Hapus",
                        cancelButtonText: "Batal",
                    }).then((result) => {
                        if(result.isConfirmed){
                            event.target.submit();
                        }
                    });
                }
            });
        }
    });
}

function ubahStatusAntrianSelesai(){
    Swal.fire({
        title: "Ubah Status Antrian",
        text: "Jika anda mengubah status antrian, maka status tersebut tidak akan dapat diubah lagi!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#006633",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "Ubah",
        cancelButtonText: "Batal",
    }).then((result) => {
        if(result.isConfirmed){
            ubahStatus('Selesai');
        }
    });
}

function ubahStatusAntrianBatal(){
    Swal.fire({
        title: "Ubah Status Antrian",
        text: "Jika anda mengubah status antrian, maka status tersebut tidak akan dapat diubah lagi!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#006633",
        cancelButtonColor: "#6b6767",
        confirmButtonText: "Ubah",
        cancelButtonText: "Batal",
    }).then((result) => {
        if(result.isConfirmed){
            ubahStatus('Batal');
        }
    });
}