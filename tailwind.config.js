import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
  // darkMode: 'class',

  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    //'./node_modules/flowbite/**/*.js',
  ],

  safelist: [
  'text-yellow-400',
  'text-gray-300',
  '!text-yellow-400',
],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
        heading: ['Anton', 'sans-serif'],
        body: ['Nunito', 'sans-serif'],
      },
      colors: {
        pine: '#2F4F4F',
        forest: '#228B22',
        sky: '#87CEEB',
        stone: '#A9A9A9',
        earth: '#8B4513',
        snow: '#F8FAFC',
        moss: '#6B8E23',
        sunset: '#FFB347',
        lake: '#4682B4',
        mist: '#E0F2F1',
      },
    },
  },

  plugins: [
    forms(),
    // require('flowbite/plugin'),
    // require('daisyui'),
  ],

  daisyui: {
    themes: [
      {
        mountainmates: {
          primary: "#228B22",      // forest
          secondary: "#6B8E23",    // moss
          accent: "#87CEEB",       // sky
          neutral: "#2F4F4F",      // pine
          "base-100": "#F8FAFC",   // snow
          info: "#4682B4",         // lake
          success: "#228B22",      // forest
          warning: "#FFB347",      // sunset
          error: "#8B0000",        // red dark
        },
      },
    ],
  },
};
