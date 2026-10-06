## Requirement

- XAMPP (Apache + MySQL)
- Composer
- Node.js + npm

## Cara menjalankan website (pertama kali)

1. Jalankan Apache dan MySQL melalui XAMPP.
2. Buka terminal pada folder project.
3. Install dependency:
   ```
   npm install
   composer install
   ```
4. Salin file environment:
   ```
   copy .env.example .env
   ```
5. Generate app key:
   ```
   php artisan key:generate
   ```
6. Buat database baru melalui phpMyAdmin.
7. Jalankan migrasi beserta seeder:
   ```
   php artisan migrate:fresh --seed
   ```
8. Buat symbolic link storage:
   ```
   php artisan storage:link
   ```
9. Build asset CSS/JS:
   ```
   npm run dev
   ```
10. Jalankan server:
    ```
    php artisan serve
    ```
    Website dapat diakses melalui `http://127.0.0.1:8000`.

## Inisialisasi repository (referensi)

Catatan setup awal repository ini:

```
echo "# Project_RPL2" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/kennethandreas/E-Learning-Website.git
git push -u origin main
```
bolte