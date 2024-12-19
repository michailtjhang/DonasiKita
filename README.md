# DonasiKita

DonasiKita is a charity platform designed to facilitate the connection between charity organizations and potential donors. It allows organizations to manage and showcase their needs and events while also providing a simple and secure platform for users to contribute to causes they care about. Through DonasiKita, users can make donations, participate in charity events, and stay updated with the organization's latest news.

## Requirements
<a href="https://laravel.com/docs/11.x/releases"><img src="https://img.shields.io/badge/laravel-v11-blue" alt="Laravel Version"></a>
<a href="https://www.php.net/releases/8.2/en.php"><img src="https://img.shields.io/badge/PHP-v8.2.4-blue" alt="PHP Version"></a>
<a href="https://getcomposer.org/download/2.6.5/composer.phar"><img src="https://img.shields.io/badge/COMPOSER-v2.6.5-brown" alt="Composer Version"></a>
<a href="https://cloudinary.com"><img src="https://img.shields.io/badge/Cloudinary-API%20Key-green" alt="Cloudinary"></a>
<a href="https://developers.google.com/identity"><img src="https://img.shields.io/badge/Google%20Login-API%20Key-red" alt="Google API"></a>
<a href="https://developers.google.com/gmail/api"><img src="https://img.shields.io/badge/Gmail%20API-Setup-yellow" alt="Gmail API"></a>
<a href="https://www.mysql.com/"><img src="https://img.shields.io/badge/MySQL-v8.0-orange" alt="MySQL"></a>

## Installation
- Download the ZIP file: <a href="https://github.com/michailtjhang/DonasiKita/archive/refs/heads/master.zip">Click here</a>
- Or clone the repository via terminal:
    ```bash
    git clone https://github.com/michailtjhang/DonasiKita.git
    ```

## Setup
1. Open the project directory in your terminal.
2. Copy the `.env.example` file to `.env`:
    ```bash
    copy .env.example .env
    ```
    For Linux:
    ```bash
    cp .env.example .env
    ```
3. Install Laravel packages:
    ```bash
    composer install
    ```
4. Generate the application key:
    ```bash
    php artisan key:generate
    ```

### Configure the Database
1. Create a new MySQL database.
2. Update the `.env` file with your database name, username, and password.
3. Run database migrations:
    ```bash
    php artisan migrate
    ```
4. Seed the database with initial data:
    ```bash
    php artisan db:seed
    ```

### Configure API Keys
1. **Cloudinary**: Add your Cloudinary API credentials to the `.env` file:
    ```env
    CLOUDINARY_API_KEY=your-cloudinary-api-key
    CLOUDINARY_API_SECRET=your-cloudinary-api-secret
    CLOUDINARY_CLOUD_NAME=your-cloudinary-cloud-name
    ```
2. **Google Login**: Add your Google API credentials to the `.env` file:
    ```env
    GOOGLE_CLIENT_ID=your-google-client-id
    GOOGLE_CLIENT_SECRET=your-google-client-secret
    GOOGLE_REDIRECT_URL=your-google-redirect-url
    ```
3. **Gmail API**: Add your Gmail API credentials to the `.env` file:
    ```env
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=your-gmail-username
    MAIL_PASSWORD=your-gmail-app-password
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=your-email@example.com
    MAIL_FROM_NAME="DonasiKita"
    ```

### Run the Application
1. Start the Laravel server:
    ```bash
    php artisan serve
    ```
2. Start the Laravel UI development server:
    ```bash
    npm run dev
    ```

## Login Accounts
- Admin and user login functionality are available for accessing backend and frontend features.

## Features
### Frontend Features
- **Homepage**: Displays key information about the organization, its mission, and ongoing activities.
- **About Us Page**: Provides details about the organization, its history, and the team.
- **Needs and Projects Listing**: Showcases specific needs (donations, supplies, etc.) with donation options and progress indicators.
- **Event Page**: Displays upcoming events with full details such as time, location, and registration options.
- **Donation Form**: Users can easily donate to specific needs or events with multiple payment options.
- **News and Blog**: Keeps users informed with updates about the organization’s activities and achievements.

### Backend Features (Admin CMS)
- **Website Pages Management**: Admins can create, edit, and delete content for pages, events, and blog posts.
- **Event Management**: Admins can manage events, including registration and participation tracking.
- **Donation Management**: Admins can view and export donation data, including donor details and transaction summaries.
- **User Management**: Admins can manage user roles and permissions.
- **Dashboard and Analytics**: Provides statistics on website visitors, donations, and user engagement.

### Other Features
- **Search Functionality**: Allows users to easily find events, needs, or articles.
- **Social Media Integration**: Users can share events, blog posts, or donation campaigns on social media.
- **Email Notifications**: Sends confirmation emails for donations and event participation.
- **Progress Bars**: Display progress towards fundraising goals on the needs and projects pages.
- **Mobile-Friendly**: The platform is designed to be responsive, ensuring it works well on both mobile and desktop devices.

### Non-Functional Requirements
- **Security**: Utilizes Laravel 11's advanced security features such as CSRF protection, encryption, and secure password hashing to ensure safe payment systems and user data.
- **Performance**: Optimized for high traffic with Laravel 11's efficient query building, caching mechanisms, and job queues for background tasks.
- **Accessibility**: Developed with Laravel 11’s flexibility in templating and responsiveness to create an inclusive and user-friendly experience across a diverse range of devices and users.

## Author
**Project for Virtual Internship MSIB7 - Group 3 (Charity Platform)**

- **[Backend - Michail](https://github.com/michailtjhang)**
- **[Frontend - Arshanda Riza Putri](https://github.com/arshandariza)**
- **[Frontend - Christian Putri](https://github.com/christianptrii)**
- **[UI/UX - I Gede Elang Perdana Dwi Putra](https://github.com/EiyaElang)**
- **[UI/UX - Firman Dafi Okta Noniko]()**
- **[Digital Marketing - Nabila Myisha]()**
- **[Digital Marketing - Vaneta Amelia Salsabila]()**
- **[Digital Marketing - Resa Landang]()**
- **[Digital Marketing - Fo'era'era Lase]()**
