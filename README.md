## Links

- Laporan Akhir Ujian Kompetensi Keahlian ada [disini](https://github.com/ahdan935/gallery-app/blob/main/public/Laporan%20UKK%20RPL.docx)
- Design Figma ada [disini](https://www.figma.com/file/8FmEfUwjvE8gDzgAwMAc8n/Gallery?type=design&node-id=0%3A1&mode=design&t=uZFTbpVOTrm9VGRD-1)

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
4. Lalu jalankan perintah ini di 2 command line berbeda:
   ```
   npm run dev
   ```
   dan
   
   ```
   php artisan serv
   ```
