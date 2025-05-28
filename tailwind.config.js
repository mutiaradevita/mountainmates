import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                heading: ['Anton', 'sans-serif'],
                body: ['Nunito', 'sans-serif'],
            },
        colors: {
            'pine': '#2F4F4F',         // hijau pinus gelap
            'forest': '#228B22',       // hijau hutan
            'sky': '#87CEEB',          // biru langit
            'stone': '#A9A9A9',        // abu batu
            'earth': '#8B4513',        // coklat tanah
            'snow': '#F8FAFC',         // putih salju
            'moss': '#6B8E23',         // hijau lumut
            'sunset': '#FFB347',       // oranye lembut
            'lake': '#4682B4',         // biru danau
            'mist': '#E0F2F1',         // abu muda berkabut
        },
        },
    },

    plugins: [
        require('flowbite/plugin'),
        require("daisyui")
    ],
};

