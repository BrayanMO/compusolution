// const { colors } = require('tailwindcss/defaultTheme');
const defaultTheme = require('tailwindcss/defaultTheme');

const colors = require('tailwindcss/colors');

module.exports = {
    // mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                blueGray: colors.blueGray,
                orange: colors.orange,
                greenLime: colors.lime,
                trueGray: colors.trueGray,
                gray: colors.gray
            }
        },
    },

    variants: {
        opacity: ({after}) => after(["disabled"])
     },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
