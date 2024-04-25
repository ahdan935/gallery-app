## Prerequisite

- PHP
- NodeJS

## Installing

1. Download repository ini lalu ekstrak atau clone menggunakan git
2. Duplicate file `.env.example` dan rename menjadi `.env`
3. Jalankan perintah:
   ```
   php artisan key:generate

   composer update
   npm install

   php artisan migrate --seed
   php artisan storage:link
   ```
4. Lalu jalankan 2 server di 2 command line berbeda:
   ```
   npm run dev
   ```
   dan
   ```
   php artisan serv
   ```
