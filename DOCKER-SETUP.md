# Setup Docker untuk Sehatin App

Panduan lengkap untuk menjalankan aplikasi Sehatin dengan Docker.

## Prasyarat

1. **Docker Desktop** - Download dari [docker.com](https://www.docker.com/products/docker-desktop)
2. **Git** - Untuk version control
3. **Make** (opsional) - Untuk menjalankan perintah yang lebih mudah

## Instalasi di Windows

### 1. Instal Docker Desktop
- Download Docker Desktop untuk Windows
- Jalankan installer dan ikuti petunjuk
- Restart komputer setelah instalasi selesai

### 2. Clone atau setup project
```bash
cd path/to/sehatin-app
```

### 3. Setup Environment
```bash
# Copy file environment untuk Docker
cp .env.docker .env

# Atau generate APP_KEY jika belum ada
docker-compose run app php artisan key:generate
```

### 4. Build dan Jalankan Containers
```bash
# Build images
docker-compose build

# Jalankan containers di background
docker-compose up -d

# Atau lihat logs realtime
docker-compose up
```

### 5. Setup Database
```bash
# Jalankan migrations
docker-compose exec app php artisan migrate

# (Opsional) Jalankan seeders
docker-compose exec app php artisan db:seed
```

### 6. Akses Aplikasi
- **Web Application**: http://localhost
- **Database**: localhost:3306
- **Redis**: localhost:6379

## Menggunakan Makefile (Alternatif)

Jika Anda memiliki Make tersedia, gunakan perintah berikut:

```bash
# Lihat semua perintah yang tersedia
make help

# Jalankan containers
make up

# Jalankan migrations
make migrate

# Buka shell di container
make shell

# Lihat logs
make logs

# Jalankan artisan command
make artisan cmd="tinker"

# Jalankan npm command
make npm cmd="install"

# Matikan containers
make down
```

## Perintah Docker Compose yang Umum

```bash
# Jalankan containers di background
docker-compose up -d

# Lihat logs
docker-compose logs -f

# Lihat logs spesifik container
docker-compose logs -f app
docker-compose logs -f nginx

# Masuk ke container
docker-compose exec app bash

# Jalankan artisan command
docker-compose exec app php artisan migrate
docker-compose exec app php artisan tinker

# Jalankan npm command
docker-compose exec app npm run build

# Jalankan tests
docker-compose exec app ./vendor/bin/phpunit

# Matikan containers
docker-compose down

# Hapus volumes
docker-compose down -v

# Rebuild images
docker-compose build --no-cache
```

## Struktur Services

### Database (MySQL)
- **Container**: sehatin_mysql
- **Port**: 3306
- **Database**: sehatin
- **User**: sehatin
- **Password**: sehatin (default, bisa diubah di .env)

### Application (PHP-FPM)
- **Container**: sehatin_app
- **Port**: 9000
- **Image**: Custom build dari Dockerfile

### Web Server (Nginx)
- **Container**: sehatin_nginx
- **Port**: 80 (HTTP), 443 (HTTPS)
- **Config**: docker/nginx/

### Cache (Redis)
- **Container**: sehatin_redis
- **Port**: 6379

## Troubleshooting

### Port sudah digunakan
```bash
# Cek port yang sedang digunakan
netstat -ano | findstr :80

# Change port di docker-compose.yml atau kill process
```

### Permission Denied
```bash
# Jalankan Docker Desktop dengan Administrator privileges
```

### Container tidak bisa connect ke database
```bash
# Cek health database
docker-compose exec db mysqladmin ping -h localhost

# Restart database
docker-compose restart db
```

### Build gagal
```bash
# Hapus cache dan build ulang
docker-compose build --no-cache
```

### Clear cache Laravel
```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan view:clear
```

## Development Tips

### Hot Reload Frontend
Vite sudah dikonfigurasi untuk hot reload. Setiap perubahan file akan otomatis ter-update.

### Database GUI Access
```bash
# Gunakan tools seperti:
# - phpMyAdmin (bisa ditambahkan ke docker-compose)
# - Workbench
# - HeidiSQL (untuk Windows)

# Connection string:
# Host: 127.0.0.1
# Port: 3306
# User: sehatin
# Password: sehatin
# Database: sehatin
```

### Monitoring
```bash
# Monitor resource usage
docker stats

# Lihat proses di container
docker-compose exec app ps aux
```

## Production Deployment

Pastikan untuk:
1. Mengubah `APP_ENV=docker` menjadi `APP_ENV=production`
2. Mengatur `APP_DEBUG=false`
3. Menggunakan environment variables yang aman
4. Setup SSL/TLS certificate untuk HTTPS
5. Menggunakan managed database service

## Next Steps

- Setup CI/CD dengan GitHub Actions
- Production deployment dengan Docker Registry
- Implementasi container orchestration (Kubernetes)

---

Untuk bantuan lebih lanjut, lihat dokumentasi resmi:
- [Docker Documentation](https://docs.docker.com/)
- [Laravel Documentation](https://laravel.com/docs)
- [Docker Compose Documentation](https://docs.docker.com/compose/)
