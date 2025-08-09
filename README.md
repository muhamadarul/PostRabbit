# 🐇 PostRabbit

**PostRabbit** adalah mini-project berbasis microservice dengan Laravel, Docker, dan RabbitMQ. Proyek ini mensimulasikan proses _publish post_ yang akan memicu pengiriman notifikasi email secara asynchronous.

---

## 🧩 Struktur Monorepo

```
post-rabbit/
├── post-service/       # Lumen service - API untuk membuat post
├── notif-service/      # Laravel service - Worker untuk kirim email notifikasi
├── docker-compose.yml  # Orkestrasi service dengan RabbitMQ
└── README.md
```

---

## 🚀 Cara Menjalankan

### 1. Clone Repository
```bash
git clone https://github.com/muhamadarul/PostRabbit.git
cd PostRabbit
```

### 2. Setting .env.docker 

### 3. Jalankan Semua Service dengan Docker
```bash
docker compose build
docker compose --env-file .env.docker up -d
```

### 4. Akses

| Service         | URL / Port             |
|-----------------|------------------------|
| Post Service    | 9000  |
| Notif Service   | 9002  |
| RabbitMQ Admin  | 15672 |

---

## 📬 Alur Kerja

1. `PostService` menerima permintaan POST `/posts`
2. Data post dikirim ke RabbitMQ queue bernama `post_queue`
3. `NotifService` mendengarkan queue dan mengirim email notifikasi menggunakan Laravel Queue Worker

---

## 📦 Teknologi

- **Laravel** – microservice untuk menerima post
- **Laravel** – service untuk mengirim email notifikasi
- **RabbitMQ** – message broker
- **Laravel Queue (via Redis/RabbitMQ)** – asynchronous job handling
- **Docker + Docker Compose** – containerisasi service

---

## ✅ Fitur

- 📨 Kirim notifikasi email tanpa blocking proses utama
- ⚙️ Arsitektur Microservice (decoupled logic)
- 🐳 Docker support untuk semua service
- 🔁 Laravel Queue Worker untuk proses background job
- 📦 RabbitMQ untuk komunikasi antar layanan

---

## 🧂 Konfigurasi Tambahan

Jika kamu butuh konfigurasi email seperti SMTP, atur `.env` di `notif-service`:
```env
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="PostRabbit"
```

---

## 🧠 Lisensi

MIT © 2025 Muhamad Arul
