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
          background: "hsl(0 0% 100%)",
          foreground: "hsl(222.2 84% 4.9%)",
          primary: {
            DEFAULT: "hsl(221.2 83.2% 53.3%)",
            foreground: "hsl(210 40% 98%)",
          },
          secondary: {
            DEFAULT: "hsl(210 40% 96.1%)",
            foreground: "hsl(222.2 47.4% 11.2%)",
          },
          muted: {
            DEFAULT: "hsl(210 40% 96.1%)",
            foreground: "hsl(215.4 16.3% 46.9%)",
          },
          border: "hsl(214.3 31.8% 91.4%)",
        },
        fontFamily: {
          sans: ["Inter", "sans-serif"],
        },
        container: {
          center: true,
          padding: "2rem",
          screens: {
            "2xl": "1400px",
          },
        },
      },
    },
    plugins: [],
  }
