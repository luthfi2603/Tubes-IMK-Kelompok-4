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

    theme: {
        extend: {
            borderRadius: {
                '4xl': '10rem'
            },
            width: {
                '100': '35rem'
            },
              height: {
                '80': '19rem'
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                body: ['Nunito+Sans'],
                poppins: ['Poppins']
            },
        },
    },

    plugins: [forms],
};