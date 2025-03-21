/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#E81B23',
        'primary-foreground': '#FFFFFF',
        foreground: '#1F2937',
        'muted-foreground': '#6B7280',
        border: '#E5E7EB',
        muted: '#F3F4F6',
        background: '#FFFFFF',
        secondary: '#4B5563',
        'secondary-foreground': '#FFFFFF',
      },
    },
  },
  plugins: [],
} 