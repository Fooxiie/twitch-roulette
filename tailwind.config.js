const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                roboto: ['Roboto Condensed', ...defaultTheme.fontFamily.sans]
            },
            colors: {
                'casino': '#972e33',
                'blackAccent': '#323232',
                'newBlack': '#1A1A1AFF'
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
