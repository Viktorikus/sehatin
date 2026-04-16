# 📱 SEHATIN - Aplikasi Kesehatan Masyarakat

## 🎯 Deskripsi Aplikasi

**Sehatin** adalah platform digital kesehatan masyarakat yang dirancang untuk menjembatani kebutuhan masyarakat awam dengan layanan kesehatan profesional. Aplikasi ini menyediakan tiga fitur utama yang terintegrasi untuk mendukung program kesehatan publik.

## 👥 Target Pengguna

- Masyarakat umum yang ingin berobat
- Pasien yang membutuhkan booking layanan kesehatan
- Individu yang ingin melaporkan gejala penyakit
- Warga yang peduli kesehatan lingkungan

## ✨ Fitur Utama

### 1️⃣ Booking Layanan Puskesmas
Memudahkan masyarakat memesan layanan kesehatan di puskesmas tanpa antri panjang.

**Fitur:**
- 📍 Pencarian puskesmas berdasarkan lokasi
- 📋 Browse layanan kesehatan dengan harga transparan
- ⏰ Booking dengan sistem jadwal online
- 📧 Notifikasi otomatis via email
- 🔔 Nomor antrian digital
- ❌ Pembatalan booking hingga 24 jam sebelum jadwal
- 📊 Riwayat booking dan status tracking

**Layanan Contoh:**
- Konsultasi Dokter Umum (Rp 100.000)
- Pemeriksaan Tekanan Darah (Rp 50.000)
- Imunisasi & Vaksin (Rp 150.000)
- Tes Laboratorium (Rp 200.000)
- Perawatan Luka (Rp 75.000)

### 2️⃣ Monitoring Penyakit Masyarakat
Platform kolaboratif untuk monitoring kesehatan publik dengan melibatkan masyarakat sebagai pelapor.

**Fitur:**
- 🦠 Laporan penyakit dengan informasi detail (gejala, tingkat keparahan)
- 🗺️ Tracking penyakit berdasarkan lokasi geografis
- 📈 Statistik penyakit real-time (Demam Berdarah, Batuk, Flu, dll)
- ⚠️ Kategori tingkat keparahan (Ringan, Sedang, Berat)
- 🔄 Status tracking (Dilaporkan → Dipantau → Selesai/Eskalasi)
- 📊 Dashboard monitoring untuk pemerintah
- 📱 Integrasi koordinat GPS untuk pemetaan

### 3️⃣ Sistem Laporan Kesehatan Lingkungan
Memudahkan masyarakat melaporkan masalah lingkungan yang berdampak kesehatan.

**Kategori Laporan:**
- 💧 Masalah Air (Pencemaran, Kualitas Air)
- 🚽 Sanitasi (Jamban Umum, Limbah)
- 🗑️ Sampah (Penumpukan, Pembuangan Ilegal)
- 💨 Polusi Udara (Asap Pabrik, Kendaraan)
- 🌍 Lainnya

**Fitur:**
- 📸 Upload foto bukti
- 🎯 Titik lokasi GPS
- ⚠️ Tingkat keparahan (Normal → Peringatan → Kritis)
- 📊 Status tracking laporan
- 📈 Dashboard dengan statistik kategori
- 🔔 Follow-up dari pihak berwenang

## 🛠️ Teknologi & Tools

### Backend
- **Framework**: Laravel 10.x
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Authentication
- **Authorization**: Laravel Policies & Gates
- **PHP Version**: 8.1+

### Frontend
- **UI Framework**: Bootstrap 5.3
- **Icons**: Bootstrap Icons
- **JavaScript**: Vanilla JS + Bootstrap JS
- **CSS**: Bootstrap + Custom Styling

### Development Tools
- **Package Manager**: Composer (PHP), npm (JavaScript)
- **Version Control**: Git
- **Server**: Apache/Nginx + PHP-FPM

## 📂 Struktur Database

### Users (Pengguna)
```
- id, name, email, password
- role (user, health_worker, admin)
- phone, address, city, district
- date_of_birth, gender, id_number (NIK)
```

### Health Centers (Puskesmas)
```
- id, name, address, phone, email
- city, district, latitude, longitude
- description, operating_hours
- is_active
```

### Health Services (Layanan Kesehatan)
```
- id, health_center_id, name, description
- price, estimated_duration, quota_per_day
- is_active
```

### Bookings (Pemesanan)
```
- id, user_id, health_service_id, health_center_id
- appointment_date, status (pending/confirmed/completed/cancelled)
- queue_number, notes, doctor_notes
```

### Disease Reports (Laporan Penyakit)
```
- id, user_id, health_center_id
- disease_name, symptom_start_date, symptoms
- severity (mild/moderate/severe)
- location_description, latitude, longitude
- status (reported/being_monitored/resolved/escalated)
- medical_assessment
```

### Environmental Health Reports (Laporan Lingkungan)
```
- id, user_id, title, description
- category (air/sanitasi/sampah/polusi/lainnya)
- severity (normal/warning/critical)
- location_address, latitude, longitude
- image_path, status, admin_notes
```

### Health Workers (Tenaga Kesehatan)
```
- id, user_id, health_center_id
- position, specialization, license_number
- bio, phone, is_active
```

## 🚀 Instalasi & Setup

### Prasyarat
- PHP 8.1 atau lebih tinggi
- Composer
- MySQL/SQLite
- Node.js (opsional)
- Git

### Langkah Instalasi

1. **Navigasi ke Folder Aplikasi**
   ```bash
   cd "d:\Semester 6\KEMJAR\Aplikasi\Kesehatan\sehatin-app"
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Konfigurasi Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup Database** (Edit `.env`)
   ```
   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=sehatin
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan Migrations**
   ```bash
   php artisan migrate
   ```

6. **Seed Data Awal**
   ```bash
   php artisan db:seed
   ```

7. **Start Development Server**
   ```bash
   php artisan serve
   ```

8. **Akses Aplikasi**
   - URL: `http://localhost:8000`
   - Email Demo: `user@example.com`
   - Password Demo: `password`

## 📋 Routes/Endpoints

### Public Routes
```
GET  /                           - Halaman Beranda
GET  /health-centers             - Daftar Puskesmas
GET  /health-centers/{id}        - Detail Puskesmas
GET  /health-centers/search      - Cari Puskesmas
GET  /health-centers/map         - Peta Puskesmas
GET  /disease-monitoring         - Monitor Penyakit (Public)
GET  /environmental-reports      - Laporan Lingkungan (Public)
GET  /login                      - Login Page
GET  /register                   - Register Page
```

### Authenticated Routes (User)
```
GET  /dashboard                  - Dashboard User
GET  /bookings                   - Daftar Layanan Booking
POST /bookings                   - Buat Booking Baru
GET  /bookings/{id}              - Detail Booking
GET  /bookings/my/list           - Booking Saya
POST /bookings/{id}/cancel       - Batalkan Booking

GET  /disease-monitoring/create  - Form Lapor Penyakit
POST /disease-monitoring         - Kirim Laporan Penyakit
GET  /disease-monitoring/{id}    - Detail Laporan Penyakit
GET  /disease-monitoring/my/reports - Laporan Saya
GET  /disease-monitoring/statistics - Statistik Penyakit

GET  /environmental-reports/create  - Form Lapor Lingkungan
POST /environmental-reports         - Kirim Laporan Lingkungan
GET  /environmental-reports/{id}    - Detail Laporan
GET  /environmental-reports/my/reports - Laporan Saya
PUT  /environmental-reports/{id}    - Update Laporan
GET  /environmental-reports/dashboard  - Dashboard Laporan

POST /logout                     - Logout
```

## 👨‍💼 User Roles & Permissions

| Role | Permissions |
|------|-------------|
| **User Biasa** | Booking, Lapor Penyakit, Lapor Lingkungan, View Dashboard |
| **Health Worker** | Confirm Booking, Process Laporan, Manage Pasien |
| **Admin** | Full Access, Manage System, Reports, Analytics |

## 📊 Key Features Detail

### Feature 1: Booking Puskesmas
- ✅ Real-time availability checking
- ✅ Email confirmation & reminders
- ✅ Queue management system
- ✅ Payment integration ready
- ✅ Rescheduling capability

### Feature 2: Disease Monitoring
- ✅ Geolocation tracking
- ✅ Severity classification
- ✅ Real-time statistics
- ✅ Public health dashboard
- ✅ Alert system untuk kasus berat

### Feature 3: Environmental Reports
- ✅ Multi-category reporting
- ✅ Photo evidence upload
- ✅ Status workflow tracking
- ✅ Government feedback system
- ✅ Impact assessment

## 🎨 UI/UX Design

Aplikasi menggunakan:
- **Design System**: Bootstrap 5 (Green Theme - #10b981)
- **Responsive**: Mobile-First Approach
- **Accessibility**: WCAG compliant
- **Performance**: Optimized loading times

### Color Palette
- Primary: #10b981 (Emerald Green)
- Secondary: #059669 (Dark Green)
- Info: #0891b2
- Warning: #f59e0b
- Danger: #ef4444

## 📱 Responsive Design

Aplikasi fully responsive untuk:
- 📱 Mobile (320px - 768px)
- 💻 Tablet (768px - 1024px)
- 🖥️ Desktop (1024px+)

## 🔒 Security Features

- ✅ CSRF Protection
- ✅ SQL Injection Prevention
- ✅ XSS Protection
- ✅ Password Hashing (bcrypt)
- ✅ Authorization Policies
- ✅ Rate Limiting Ready
- ✅ File Upload Validation

## 📈 Performance Tips

- Database indexing pada frequently queried columns
- Eager loading relationships (Laravel's `with()`)
- Query optimization dan pagination
- Asset minification ready
- Caching strategy ready

## 🐛 Testing (Siap Dikembangkan)

```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter=BookingTest
```

## 📚 API Documentation (Siap Dikembangkan)

Dokumentasi API dapat dihasilkan menggunakan Swagger/OpenAPI dengan package:
```bash
composer require darkaonline/l5-swagger
```

## 🤝 Kontribusi

Untuk mengembangkan aplikasi lebih lanjut:

1. Fork repository
2. Buat branch feature baru
3. Commit perubahan dengan pesan yang jelas
4. Push ke branch
5. Buat Pull Request

## 📝 Pengembangan Lanjutan

Fitur yang dapat ditambahkan:

1. **Telemedicine Integration** - Konsultasi dokter online
2. **Payment Gateway** - Pembayaran online (Stripe, GoPay)
3. **SMS Notifications** - Notifikasi via SMS
4. **Mobile App** - Flutter/React Native App
5. **AI/ML Analytics** - Predictive analytics penyakit
6. **Map Integration** - Integration dengan Google Maps
7. **Multi-language Support** - Integrasi lebih banyak bahasa
8. **Admin Dashboard** - Analytics & reporting dashboard
9. **Integration dengan SIHA/PUSKESMAS** - Integrasi sistem pemerintah
10. **Gamification** - Reward system untuk user aktif

## 🆘 Troubleshooting

### Database Connection Error
- Pastikan MySQL running
- Cek konfigurasi `.env`
- Buat database baru: `php artisan db:create`

### Migrations Failed
```bash
php artisan migrate:reset
php artisan migrate:fresh --seed
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📞 Support & Contact

- 📧 Email: info@sehatin.id
- 📱 Phone: +62 123 4567
- 🌐 Website: www.sehatin.id
- 💬 Chat: support@sehatin.id

## 📄 Lisensi

Aplikasi Sehatin adalah open source di bawah lisensi **MIT**.

## 🎓 Credits

Dikembangkan sebagai aplikasi kesehatan digital untuk mendukung program kesehatan publik Indonesia.

---

**"Kesehatan adalah investasi terbaik. Mari bersama jaga kesehatan masyarakat dengan Sehatin!"** 💚

**Version**: 1.0.0  
**Last Updated**: April 15, 2024  
**Status**: Active Development
