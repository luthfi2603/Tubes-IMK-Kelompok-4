import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './public/assets/js/*.js',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            borderRadius: {
                '4xl': '10rem'
            },
            width: {
                '100': '30rem'
            },
            height: {
                '80': '19rem',
                '90': '20rem',
                '150': '120vh',
                '200': '150vh',
                '25': '7rem',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                body: ['Nunito Sans'],
                poppins: ['Poppins']
            },
        },
    },

    plugins: [forms],
};