import defaultTheme from 'tailwindcss/defaultTheme'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
          colors: {
            primary: {"50":"#ecfeff","100":"#cffafe","200":"#a5f3fc","300":"#67e8f9","400":"#22d3ee","500":"#06b6d4","600":"#0891b2","700":"#0e7490","800":"#155e75","900":"#164e63","950":"#083344"}
          }
        },
      //   fontFamily: {
      //     'body': [
      //   'Open Sans', 
      //   'ui-sans-serif', 
      //   'system-ui', 
      //   '-apple-system', 
      //   'system-ui', 
      //   'Segoe UI', 
      //   'Roboto', 
      //   'Helvetica Neue', 
      //   'Arial', 
      //   'Noto Sans', 
      //   'sans-serif', 
      //   'Apple Color Emoji', 
      //   'Segoe UI Emoji', 
      //   'Segoe UI Symbol', 
      //   'Noto Color Emoji'
      // ],
      //     'sans': [
      //   'Open Sans', 
      //   'ui-sans-serif', 
      //   'system-ui', 
      //   '-apple-system', 
      //   'system-ui', 
      //   'Segoe UI', 
      //   'Roboto', 
      //   'Helvetica Neue', 
      //   'Arial', 
      //   'Noto Sans', 
      //   'sans-serif', 
      //   'Apple Color Emoji', 
      //   'Segoe UI Emoji', 
      //   'Segoe UI Symbol', 
      //   'Noto Color Emoji'
      // ]
      //   }
    },
    plugins: [require("flowbite/plugin")],
}
