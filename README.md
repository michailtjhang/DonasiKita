# About DonasiKita
DonasiKita adalah sebuah 

## Requirements
<a href="https://laravel.com/docs/11.x/releases"><img src="https://img.shields.io/badge/laravel-v11-blue" alt="version laravel"></a>
<a href="https://www.php.net/releases/8.2/en.php"><img src="https://img.shields.io/badge/PHP-v8.2.4-blue" alt="version php"></a>
<a href="https://nodejs.org/en/blog/release/v8.18.0"><img src="https://img.shields.io/badge/NPM-v8.18.0-green" alt="version php"></a>
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
- menginstal npm UI di website, ketikan command :
  ```bash
  npm install
  ```
- Generate app key, ketikan command :
  ```bash
  php artisan key:generate
  ```
### Command Public Package (Wajib)
-   menjalankan storage di website, ketikan command :
    ```bash
    php artisan storage:link
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

## Akun Login

## Fitur

## Author
Projek Virtual Internship MSIB7 - Group 3 (Charity Platform)

- **[Backend - Michail](https://github.com/michailtjhang)**
- **[Frontend - Arshada Riza Putri](https://github.com/arshandariza)**
- **[Frontend - Christian Putri](https://github.com/christianptrii)**
- **[UI/UX - ]()**
- **[UI/UX - ]()**
- **[Digital Marketing - ]()**
- **[Digital Marketing - ]()**
- **[Digital Marketing - ]()**
