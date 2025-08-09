# 🐇 PostRabbit

**PostRabbit** adalah mini-project berbasis microservice dengan Laravel, Docker, dan RabbitMQ. Proyek ini mensimulasikan proses _publish post_ yang akan memicu pengiriman notifikasi email secara asynchronous.

---

## 🧩 Struktur Monorepo

```
post-rabbit/
├── post-service/       # Laravel  service - API untuk membuat post (Producer)
├── notif-service/      # Laravel service - Worker untuk kirim email notifikasi (Worker & Consumer)
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

### 2. Setting .env

1. Konfigurasi .env.docker buat jika belum ada ambil dari .env.docker.example 
2. Konfigurasi .env di post-service database, redis, dan rabbitmq
2. Konfigurasi .env di notif-service redis, dan rabbitmq


### 3. Jalankan Semua Service dengan Docker
```bash
docker compose build
docker compose --env-file .env.docker up -d
```

### 4. Akses

| Service         | URL / Port             |
|-----------------|------------------------|
| Post Service    | 9001  |
| Notif Service   | 9002  |
| RabbitMQ Admin  | 15672 |

---

## 📬 Alur Kerja

1. `PostService` menerima permintaan POST `api/posts`
2. Data post dikirim ke RabbitMQ queue bernama `post_queue`
3. `NotifService` mendengarkan queue dan mengirim email notifikasi menggunakan Laravel Queue Worker

Producer kirim job ke RabbitMQ queue. Notif service (sebagai consumer + worker) ambil job dari RabbitMQ dan langsung mengeksekusi pengiriman email di method handle() jobnya.


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
