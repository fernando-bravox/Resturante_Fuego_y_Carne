/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./presentation/pages/**/*.{html,js,php}"],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}