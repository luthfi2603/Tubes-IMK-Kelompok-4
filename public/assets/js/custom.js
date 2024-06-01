//dark mode toggle
const html = document.querySelector('html');
const moon = document.getElementById('moon');
const sun = document.getElementById('sun');

const toggleDark = () => {
    html.classList.add('dark');
    localStorage.theme = 'dark';
    sun.classList.toggle('scale-0');
    moon.classList.toggle('scale-0');
    moon.classList.add('duration-300');
    sun.classList.add('duration-300');
};

const toggleLight = () => {
    html.classList.remove('dark');
    localStorage.theme = 'light';
    moon.classList.toggle('scale-0');
    sun.classList.toggle('scale-0');
    sun.classList.add('duration-300');
    moon.classList.add('duration-300');
};

// ubah toggle
if(localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)){
    // moon.classList.toggle('scale-0');
    sun.classList.toggle('scale-0');
}else{
    // sun.classList.toggle('scale-0');
    moon.classList.toggle('scale-0');
}