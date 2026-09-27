# 📋 PANDUAN DEPLOY PERBAIKAN GAMBAR - LBH Punggawa Keadilan

## 🎯 Yang Sudah Diperbaiki
✅ Backend: Upload gambar memakai path lokal (`uploads/article_....jpg`)
✅ Frontend: Function `normalizeImage()` handle URL & path lokal
✅ Artikel & Galeri: Siap tampilkan gambar hasil upload

---

## 🚀 OPSI DEPLOY

### **OPSI 1: cPanel (Hosting Indo/Lokal)**

#### Langkah 1: Update via Git di cPanel
```bash
1. Login ke cPanel → Terminal (atau SSH)
2. Masuk folder project:
   cd /home/username/public_html/lbh
   # atau
   cd /var/www/html/lbh

3. Pull perubahan terbaru:
   git pull origin main
   
4. Jika git belum ada, manual upload:
   - Download repo dari GitHub (.zip)
   - Extract di File Manager cPanel
   - Ganti semua file di folder project
```

#### Langkah 2: Buat Folder Uploads
```bash
# Via Terminal:
mkdir -p /home/username/public_html/lbh/uploads/avatars
chmod 755 /home/username/public_html/lbh/uploads
chmod 755 /home/username/public_html/lbh/uploads/avatars

# Via File Manager cPanel:
1. Navigasi ke folder project
2. Klik tombol Create Folder
3. Buat folder "uploads"
4. Di dalam uploads, buat folder "avatars"
5. Klik kanan folder → Change Permissions
6. Set ke 755 (read/write/execute)
```

#### Langkah 3: Clear Browser Cache & Test
```
1. Buka https://yourdomain.com
2. Tekan Ctrl+Shift+Delete (hard refresh)
3. Login dengan kredensial demo
4. Masuk ke Manajemen Web → Konten Web
5. Coba tambah artikel + upload gambar
```

---

### **OPSI 2: VPS/Dedicated Server (SSH)**

#### Langkah 1: SSH Login
```bash
ssh user@your-server-ip
cd /var/www/html/lbh  # atau path project Anda
```

#### Langkah 2: Pull & Setup Folders
```bash
# Pull perubahan terbaru
git pull origin main

# Buat folder uploads dengan permission tepat
mkdir -p uploads/avatars
chmod 755 uploads
chmod 755 uploads/avatars

# Verifikasi struktur
ls -la uploads
# Output harus:
# drwxr-xr-x  avatars
# drwxr-xr-x  uploads
```

#### Langkah 3: Restart Web Server
```bash
# Jika pakai Nginx:
sudo systemctl restart nginx

# Jika pakai Apache:
sudo systemctl restart apache2
```

---

### **OPSI 3: FTP Manual (No Terminal)**

#### Langkah 1: Download & Upload Files
```
1. Download source code dari GitHub:
   https://github.com/lamporcangkring/LBH → Code → Download ZIP

2. Extract ZIP file di komputer lokal

3. Buka FTP Client (WinSCP, FileZilla, dll)
   - Host: ftp.yourdomain.com
   - Username & Password dari hosting provider
   
4. Upload ke folder /public_html/lbh atau sesuai path hosting

5. Jika ada file lama, hapus/overwrite dengan versi baru
```

#### Langkah 2: Buat Folder Uploads
```
1. Di FTP Client, navigasi ke /public_html/lbh
2. Klik kanan → Create Folder → ketik "uploads"
3. Masuk folder uploads → Create Folder → ketik "avatars"
4. Klik kanan folder uploads → Properties → set ke 755
5. Klik kanan folder avatars → Properties → set ke 755
```

---

## ✅ VERIFIKASI DEPLOY BERHASIL

Setelah upload, buka browser dan cek:

### Test 1: Halaman Landing Muncul
```
https://yourdomain.com
Harus tampil halaman utama dengan artikel & galeri
```

### Test 2: Upload Gambar Berfungsi
```
1. Login: admin / admin123
2. Klik "Manajemen Web" → "Konten Web"
3. Tambah Artikel baru
4. Upload gambar dari komputer
5. Klik Simpan
6. Lihat hasilnya di halaman landing (menu Artikel)
```

### Test 3: Cek File Upload
```
Via cPanel File Manager atau FTP:
Buka folder: /uploads/
Harus ada file gambar seperti:
- article_1727410800_abc12345.jpg
- article_1727410805_def67890.png
```

---

## 🔧 TROUBLESHOOTING

### ❌ Gambar tidak muncul di landing page
**Solusi:**
```
1. Cek folder uploads sudah ada dan bisa ditulis
2. Cek file gambar sudah tersimpan di /uploads/
3. Hard refresh browser (Ctrl+Shift+Delete)
4. Cek console browser (F12) ada error apa
```

### ❌ Upload gambar error "Gagal menyimpan file"
**Solusi:**
```
1. Set permission folder uploads jadi 755 atau 777
2. Pastikan hosting tidak limit ukuran upload
3. Cek folder avatars juga sudah ada permission 755
```

### ❌ Masih muncul URL panjang tua
**Solusi:**
```
1. Di browser, tekan Ctrl+Shift+Delete
2. Hapus cache & cookies
3. Login ulang
4. Reload halaman landing
```

---

## 📝 QUICK CHECKLIST

- [ ] File api.php sudah update (ada function upload)
- [ ] File index.php sudah update (ada normalizeImage)
- [ ] Folder /uploads sudah ada
- [ ] Folder /uploads/avatars sudah ada
- [ ] Permission uploads = 755
- [ ] Permission avatars = 755
- [ ] Browser cache sudah dihapus
- [ ] Coba upload artikel & gambar
- [ ] Gambar muncul di landing page

---

## 📞 Butuh Bantuan?

Kalau ada error, pastikan:
1. **Sebutkan tipe hosting**: cPanel / VPS / lainnya
2. **Copy error message** lengkap (dari F12 Console atau terminal)
3. **Attachment file**: hasil screenshot error

---

**Status:** ✅ Siap Deploy
**Tanggal Update:** 27 Sept 2026
**Commit:** caa0cece
