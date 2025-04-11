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
          neutral: {
            50: '#f9fafb',
          },
          gray: {
            800: '#1f2937',
            600: '#4b5563',
            500: '#6b7280',
          },
          red: {
            50: '#fef2f2',
            100: '#fee2e2',
            600: '#dc2626',
            700: '#b91c1c',
            800: '#991b1b',
            900: '#7f1d1d',
            900: '#881337', // Added red-900 as in gradient
          },
          green: {
            100: '#f0fdf4',
            600: '#16a34a',
            700: '#15803d',
            900: '#166534', // Added green-900 as in gradient
          },
          indigo: {
            100: '#e0e7ff',
            600: '#4f46e5',
            700: '#4338ca',
            800: '#3730a3',
          },
        },
      },
      fontFamily: {
        'montserrat': ['Montserrat', 'sans-serif'],
      },
    },
    plugins: [],
  }
