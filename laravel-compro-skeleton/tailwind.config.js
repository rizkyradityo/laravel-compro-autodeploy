/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './resources/js/**/*.vue',
    './app/Http/Livewire/**/*.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};