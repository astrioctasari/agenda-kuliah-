# Backend Agenda Kuliah (Laravel + MySQL)

Backend ini menyediakan API buat nyimpen data Jadwal, Catatan, Tugas, dan Galeri
secara permanen di database — jadi data kamu nggak hilang lagi kayak sebelumnya.

## Langkah Setup

### 1. Buat project Laravel baru
```bash
composer create-project laravel/laravel agenda-kuliah-api
cd agenda-kuliah-api
```

### 2. Install Sanctum (buat sistem login/token)
Laravel 11 biasanya udah include Sanctum, tapi pastikan sudah di-scaffold:
```bash
php artisan install:api
```
(Kalau ditanya, pilih "yes" untuk migrasi.)

### 3. Copy file-file dari paket ini ke project Laravel kamu
Timpa/salin ke folder yang sama persis:

- `database/migrations/*.php` → `agenda-kuliah-api/database/migrations/`
- `app/Models/*.php` → `agenda-kuliah-api/app/Models/`
- `app/Http/Controllers/Api/*.php` → `agenda-kuliah-api/app/Http/Controllers/Api/`
- `routes/api.php` → timpa `agenda-kuliah-api/routes/api.php`
- `config/cors.php` → timpa `agenda-kuliah-api/config/cors.php`

### 4. Setup database
Buat database MySQL baru, misal namanya `agenda_kuliah`.
Edit file `.env` di project Laravel:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agenda_kuliah
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Jalankan migrasi
```bash
php artisan migrate
```
Ini bikin tabel: `users` (dengan kolom nama & hp tambahan), `jadwals`, `catatans`,
`tugas_list`, `galeris`, dan tabel token Sanctum.

### 6. Jalankan server
```bash
php artisan serve
```
Backend jalan di `http://127.0.0.1:8000`, API base URL-nya: `http://127.0.0.1:8000/api`

### 7. Sambungkan ke frontend
Buka file `index.html` (versi web app-nya), cari baris:
```js
const API_BASE = 'http://127.0.0.1:8000/api';
```
Ganti sesuai alamat backend kamu. Kalau mau diakses dari HP di WiFi yang sama,
ganti `127.0.0.1` jadi IP laptop kamu (cek dengan `ipconfig`/`ifconfig`), misal:
```js
const API_BASE = 'http://192.168.1.5:8000/api';
```
Lalu jalankan servernya dengan: `php artisan serve --host=0.0.0.0`

## Daftar Endpoint API

| Method | Endpoint | Keterangan |
|---|---|---|
| POST | `/api/register` | Daftar akun baru `{nama, hp, password}` |
| POST | `/api/login` | Login `{hp, password}` → dapat token |
| POST | `/api/logout` | Logout (butuh token) |
| GET | `/api/me` | Info profil yang login |
| GET/POST | `/api/jadwal` | Lihat/tambah jadwal |
| PUT/DELETE | `/api/jadwal/{id}` | Edit/hapus jadwal |
| GET/POST | `/api/catatan` | Lihat/tambah catatan |
| PUT/DELETE | `/api/catatan/{id}` | Edit/hapus catatan |
| GET/POST | `/api/tugas` | Lihat/tambah tugas |
| PUT/DELETE | `/api/tugas/{id}` | Edit/hapus tugas |
| GET/POST | `/api/galeri` | Lihat/tambah gambar |
| DELETE | `/api/galeri/{id}` | Hapus gambar |

Semua endpoint (kecuali register/login) butuh header:
```
Authorization: Bearer <token dari hasil login>
```

## Deploy biar bisa diakses dari mana aja (bukan cuma WiFi rumah)

Kalau mau backend-nya online 24 jam (bisa diakses dari HP di luar rumah), kamu perlu
hosting yang support PHP + MySQL, contoh:
- **Railway.app** / **Render.com** — ada free tier buat coba-coba
- **Hostinger / Niagahoster** — hosting lokal, murah, support Laravel
- **VPS** (DigitalOcean, dsb) — lebih fleksibel tapi perlu setup manual

Setelah deploy, ganti `API_BASE` di frontend ke domain backend kamu, misal:
```js
const API_BASE = 'https://api-agendaku.xxxx.com/api';
```
