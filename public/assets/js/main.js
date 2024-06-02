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
document.querySelectorAll('.dropdown').forEach(function (item, index) {
    const popperId = 'popper-' + index
    const toggle = item.querySelector('.dropdown-toggle')
    const menu = item.querySelector('.dropdown-menu')
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
        placement: 'bottom-end'
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

        if(location.pathname == '/admin/perawat'){
            if(statusCariPerawat){
                statusCariPerawat = false;
                location.reload();
            }
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

const fullscreenButton = document.getElementById('fullscreen-button');

fullscreenButton.addEventListener('click', toggleFullscreen);

function toggleFullscreen() {
    if (document.fullscreenElement) {
        // If already in fullscreen, exit fullscreen
        document.exitFullscreen();
    } else {
        // If not in fullscreen, request fullscreen
        document.documentElement.requestFullscreen();
    }
}