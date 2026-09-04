<<<<<<< HEAD
# CI Vuln Lab — CodeIgniter 3.1.0 Vulnerable Practice App

⚠️ **PERINGATAN KERAS**
Aplikasi ini **sengaja dibuat rentan** untuk keperluan latihan/lab keamanan
(pentest, SOC training, secure code review). **JANGAN**:
- Deploy ke server yang bisa diakses dari internet publik.
- Gunakan kredensial atau data asli.
- Jadikan kode ini referensi coding untuk aplikasi produksi.

Jalankan hanya di environment terisolasi: VM lokal, container Docker tanpa
port publik, atau jaringan lab/CTF internal.

---

## Base framework
CodeIgniter **3.1.0** (di-clone langsung dari tag resmi `bcit-ci/CodeIgniter`).
Versi ini sudah lama dan tidak lagi didapat security patch — cocok sebagai
dasar lab, di luar kerentanan custom yang ditambahkan di bawah.

## Kerentanan yang disematkan

| # | Modul | Jenis Kerentanan | Lokasi | Contoh Payload |
|---|-------|-------------------|--------|-----------------|
| 1 | Auth | SQL Injection (login bypass) | `controllers/Auth.php::login()` | username: `admin' -- ` |
| 2 | Auth | Password plaintext, no hashing | `controllers/Auth.php` | — |
| 3 | Auth | Session fixation (no regen id) | `controllers/Auth.php::login()` | — |
| 4 | Search | SQL Injection (UNION-based) | `controllers/Search.php` | `q=' UNION SELECT username,password,3 FROM users -- ` |
| 5 | Search | Reflected XSS | `views/search/result.php` | `q=<script>alert(document.cookie)</script>` |
| 6 | Profile | IDOR (broken access control) | `controllers/Profile.php::view()` | ganti `/profile/view/1` jadi `/profile/view/2` |
| 7 | Tools | OS Command Injection | `controllers/Tools.php::ping()` | `host=127.0.0.1; id` |
| 8 | Upload | Unrestricted file upload → potensi RCE | `controllers/Upload.php` | upload `shell.php`, akses via `/uploads/shell.php` |

Setiap file controller punya komentar block yang menjelaskan kerentanan apa
yang sengaja ditanam di situ, supaya gampang dipakai bahan diskusi/training.

## Setup — Docker (paling cepat)

Butuh Docker + Docker Compose terinstall. Lalu:

```bash
cd ci-vuln-lab
docker compose up --build
```

- App otomatis jalan di `http://127.0.0.1:8000/` (sengaja **hanya** bind ke
  `127.0.0.1`, tidak ke `0.0.0.0`, supaya tidak keekspos ke jaringan lain).
- Database MySQL otomatis dibuat dan `schema.sql` otomatis di-import saat
  container `db` pertama kali start (via `docker-entrypoint-initdb.d`).
- Database **tidak** di-expose ke host (tidak ada `ports:` untuk service
  `db`) — hanya bisa diakses dari container `web` lewat jaringan Docker
  internal (`vulnlab`).
- Untuk stop: `docker compose down`. Untuk reset total (termasuk data DB):
  `docker compose down -v`.

⚠️ Meski port cuma bind ke `127.0.0.1`, kalau VM kamu sendiri diakses dari
luar (misalnya cloud VM dengan IP publik + SSH), tetap terapkan isolasi
jaringan di level VM (security group / firewall) — jangan andalkan bind
`127.0.0.1` saja sebagai satu-satunya lapisan proteksi.

## Setup — Manual (tanpa Docker)

1. **Web server + PHP 7.x** (CI 3.1.0 cocok di PHP 5.6–7.x; kalau pakai PHP
   modern mungkin ada warning deprecated, itu wajar untuk kode se-tua ini).
2. Buat database MySQL:
   ```sql
   CREATE DATABASE ci_vuln_lab;
   CREATE USER 'vulnlab'@'localhost' IDENTIFIED BY 'vulnlab';
   GRANT ALL ON ci_vuln_lab.* TO 'vulnlab'@'localhost';
   ```
3. Import schema & data contoh:
   ```bash
   mysql -u vulnlab -p ci_vuln_lab < schema.sql
   ```
4. Sesuaikan kredensial DB kalau perlu di `application/config/database.php`.
5. Jalankan dengan PHP built-in server (untuk lab lokal saja):
   ```bash
   php -S 127.0.0.1:8000
   ```
6. Buka `http://127.0.0.1:8000/` — otomatis ke halaman login (`Auth`).

## Rute penting

- `/auth` — login form (SQLi login bypass)
- `/search?q=...` — search user (SQLi UNION + reflected XSS)
- `/profile/view/<id>` — profil user (IDOR, perlu login dulu)
- `/tools/ping?host=...` — ping tool (command injection)
- `/upload` — form upload file (unrestricted upload)

## Ide latihan

- Bypass login tanpa tahu password pakai SQLi di field username.
- Dump isi tabel `users` (termasuk password plaintext) lewat UNION-based
  SQLi di endpoint search.
- Akses profil user lain tanpa izin lewat IDOR.
- Coba command injection di ping tool untuk baca file sistem
  (`127.0.0.1; cat /etc/passwd` — hanya di VM lab kamu sendiri).
- Upload web shell dan coba akses untuk RCE, lalu diskusikan mitigasinya
  (whitelist ekstensi, simpan di luar webroot, rename file, dsb).
- Setelah eksploitasi, coba **perbaiki** tiap kerentanan sebagai latihan
  secure coding (query binding, `htmlspecialchars()`/output escaping,
  ownership check, `escapeshellarg()`, validasi upload, dsb).

## Disclaimer
Proyek ini dibuat murni untuk edukasi dan pengujian keamanan di environment
yang kamu kontrol sendiri. Penulis tidak bertanggung jawab atas
penyalahgunaan di luar konteks tersebut.
=======
# ci-vuln-lab
Cyberdril App Lab
>>>>>>> origin/main
