/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'toms-green': '#6B8E6B',
        'toms-dark': '#2C3E3C',
      },
    },
  },
  plugins: [],
}

