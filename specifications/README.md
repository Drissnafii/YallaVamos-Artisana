# 🏆 Guide de la Coupe du Monde au Maroc 2030

An interactive web guide for the FIFA World Cup 2030 co-hosted by Morocco, providing essential information for international visitors, football fans, and local residents.

## 🌟 Features

### For Visitors

*   Browse host cities and their cultural attractions.
*   View stadium details and match schedules.
*   Find accommodation and transportation options.
*   Access visa and cultural information.
*   Save favorite cities, matches, and venues.
*   Read the latest World Cup news and updates.

### For Administrators

*   Manage cities, stadiums, and matches.
*   Update accommodation listings.
*   Publish news and articles.
*   Manage user accounts.

## 🛠 Tech Stack

*   **Back-end:** Laravel (PHP)
*   **Database:** MySQL
*   **Front-end:** HTML, Tailwind CSS, JavaScript
*   **Architecture:** Model-View-Controller (MVC) with Repository Pattern

## 📋 Prerequisites

*   PHP >= 8.1
*   Composer
*   Node.js & NPM (if you choose to use Vite or Laravel Mix)
*   MySQL
*   Git

## 🚀 Installation

1.  Clone the repository:

    ```bash
    git clone https://github.com/yourusername/worldcup-morocco-guide.git
    cd worldcup-morocco-guide
    ```

2.  Navigate to the back-end directory:

     ```bash
     cd source/back-office
     ```

3.  Install back-end dependencies:
    ```bash
    composer install
    ```
4.  Navigate to the project root directory:
     ```bash
     cd ../..
     ```

5.  Install front-end dependencies (if using Vite or Laravel Mix):

    ```bash
     cd source/front-office
    npm install
    ```

6.  Configure the environment:
    ```bash
     cd ../../
    cp source/back-office/.env.example source/back-office/.env
    php source/back-office/artisan key:generate
    ```

7.  Set up the database:

    ```bash
    php source/back-office/artisan migrate
    php source/back-office/artisan db:seed
    ```
8. Start development servers:
    ```bash
    php source/back-office/artisan serve
    npm run dev  (if using Vite or Laravel Mix)
    ```


## 🔒 Security

*   Custom authentication system (built from scratch).
*   CSRF (Cross-Site Request Forgery) protection.
*   XSS (Cross-Site Scripting) prevention.
*   Input validation.
*   Secure password handling.

## 👥 Contributing

1.  Fork the repository.
2.  Create a feature branch.
3.  Commit your changes.
4.  Push to the branch.
5.  Create a Pull Request.

## 📝 License

[MIT License](LICENSE) (if you choose to use one)

## 👨‍💻 Authors

*   [Your Name](https://github.com/yourusername)

## 🤝 Acknowledgements

*   FIFA World Cup 2030 Committee.
*   Moroccan Football Federation.
*   Project Supervisors.

## 📞 Support

For support, email [your-email@domain.com](mailto:your-email@domain.com).