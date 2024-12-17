# About DonasiKita
DonasiKita is a charity platform designed to facilitate the connection between charity organizations and potential donors. It allows organizations to manage and showcase their needs and events, while also providing a simple and secure platform for users to contribute to causes they care about. Through DonasiKita, users can make donations, participate in charity events, and stay updated with the organization's latest news.

## Requirements
<a href="https://laravel.com/docs/11.x/releases"><img src="https://img.shields.io/badge/laravel-v11-blue" alt="version laravel"></a>
<a href="https://www.php.net/releases/8.2/en.php"><img src="https://img.shields.io/badge/PHP-v8.2.4-blue" alt="version php"></a>
<a href="https://getcomposer.org/download/2.6.5/composer.phar"><img src="https://img.shields.io/badge/COMPOSER-v2.6.5-brown" alt="version php"></a>

## Instalasi
- download zip <a href="https://github.com/michailtjhang/DonasiKita/archive/refs/heads/master.zip">Klik disini</a> 
- atau clone di terminal :
    ```bash
    git clone https://github.com/michailtjhang/DonasiKita.git
    ```

## Setup
- buka direktori project di terminal anda.
- ketikan command di terminal :
  ```bash
  copy .env.example .env
  ```
  untuk Linuk, ketikan command :
  ```bash
  cp .env.example .env
  ```
- instal package-package di laravel, ketikan command :
  ```bash
  composer install
  ```
- Generate app key, ketikan command :
  ```bash
  php artisan key:generate
  ```
### Command Database
- buatlah nama database baru. Lalu sesuaikan nama database, username, dan password database di file `.env`, ketikan command :
  ```bash
  php artisan migrate
  ```
- memasukkan data table ke database, ketikan command :
  ```bash
  php artisan db:seed
  ```
- menjalankan laravel di website, ketikan command :
  ```bash
  php artisan serve
  ```
### Command Run Website
- menjalanlan Laravel di website, ketikan command :
  ```bash
  php artisan serve
  ```
- menjalanlan UI Laravel di website, ketikan command :
  ```bash
  npm run dev
  ```

## Akun Login
- Admin and user login functionality are available for accessing backend and frontend features.

## Fitur
### Frontend Features
- Homepage: Displays key information about the organization, its mission, and ongoing activities.
- About Us Page: Provides details about the organization, its history, and the team.
- Needs and Projects Listing: Showcases specific needs (donations, supplies, etc.) with donation options and progress indicators.
- Event Page: Displays upcoming events with full details such as time, location, and registration options.
- Donation Form: Users can easily donate to specific needs or events with multiple payment options.
- News and Blog: Keeps users informed with updates about the organization’s activities and achievements.
### Backend Features (Admin CMS)
- Pages Website Management: Admins can create, edit, and delete content for pages, events, and blog posts.
- Event Management: Admins can manage events, including registration and participation tracking.
- Donation Management: Admins can view and export donation data, including donor details and transaction summaries.
- User Management: Admins can manage user roles and permissions.
- Dashboard and Analytics: Provides statistics on website visitors, donations, and user engagement.
### Other Features
- Search Functionality: Allows users to easily find events, needs, or articles.
- Social Media Integration: Users can share events, blog posts, or donation campaigns on social media.
- Email Notifications: Sends confirmation emails for donations.
- Progress Bars: Display progress towards fundraising goals on the needs and projects pages.
- Mobile-Friendly: The platform is designed to be responsive, ensuring it works well on both mobile and desktop devices.
### Non-Functional Requirements
- Security: Leveraging Laravel 11's advanced security features, such as CSRF protection, encryption, and secure password hashing, to ensure the safety of payment systems and user data.
- Performance: Optimized to handle high traffic with Laravel 11's efficient query building, caching mechanisms, and job queues for background tasks.
- Accessibility: Developed with Laravel 11’s flexibility in templating and responsiveness to create an inclusive and user-friendly experience across a diverse range of devices and users.

## Author
Projek Virtual Internship MSIB7 - Group 3 (Charity Platform)

- **[Backend - Michail](https://github.com/michailtjhang)**
- **[Frontend - Arshanda Riza Putri](https://github.com/arshandariza)**
- **[Frontend - Christian Putri](https://github.com/christianptrii)**
- **[UI/UX - I Gede Elang Perdana Dwi Putra](https://github.com/EiyaElang)**
- **[UI/UX - Firman Dafi Okta Noniko]()**
- **[Digital Marketing - Nabila Myisha]()**
- **[Digital Marketing - Vaneta Amelia Salsabila]()**
- **[Digital Marketing - Resa Landang]()**
- **[Digital Marketing - Fo'era'era Lase]()**
