import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            // --- BAGIAN INI WAJIB ADA ---
            colors: {
                lapas: {
                    navy: '#0f2744',   // Biru Gelap
                    blue: '#1e40af',   // Biru Standar
                    accent: '#3b82f6', // Biru Terang (Aksen)
                    gold: '#fbbf24',   // Emas
                    slate: '#334155',  // Abu-abu
                }
            }
            // -----------------------------
        },
    },

    plugins: [forms],
};