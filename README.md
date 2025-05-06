# TP8DPBO2025C2

Saya Marco Henrik Abineno dengan NIM 2301093 mengerjakan Tugas Praktikum 8 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Desain Program

Tugas Praktikum 8 kali ini adalah bikin aplikasi buat ngelola data mahasiswa. Aplikasinya pakai konsep arsitektur MVC (Model-View-Controller), jadi kodenya lebih rapi dan terstruktur. Di dalam aplikasi ini juga harus ada fitur CRUD lengkap (Create, Read, Update, Delete) buat setiap tabel di database. Selain itu, wajib ada minimal satu relasi antar tabel dan nambah setidaknya dua tabel baru.  

## 1. Diagram ERD dan Relasi

![image](https://github.com/user-attachments/assets/77fd0f5e-9376-468d-bd5c-40afb288aba0)

1. Students  
Berikut isi atribut serta deskripsinya:

| Atribut     | Tipe Data | Keterangan                     |
| ----------- | --------- | ------------------------------ |
| id          | INT       | Primary Key, auto increment    |
| name        | VARCHAR   | Nama mahasiswa                 |
| nim         | VARCHAR   | Nomor Induk Mahasiswa          |
| phone       | VARCHAR   | Nomor telepon mahasiswa        |
| join\_date  | DATE      | Tanggal masuk                  |
| id\_kelas   | INT       | Foreign Key ke tabel `kelas`   |
| id\_jurusan | INT       | Foreign Key ke tabel `jurusan` |

2. Kelas  
Berikut isi atribut serta deskripsinya:
  
| Atribut     | Tipe Data | Keterangan                  |
| ----------- | --------- | --------------------------- |
| id          | INT       | Primary Key, auto increment |
| nama\_kelas | VARCHAR   | Nama kelas                  |

3. Jurusan  
Berikut isi atribut serta deskripsinya:
  
| Atribut     | Tipe Data | Keterangan                  |
| ----------- | --------- | --------------------------- |
| id          | INT       | Primary Key, auto increment |
| nama\_kelas | VARCHAR   | Nama kelas                  |

## 2. Arsitektur MVC dan Template

Di arsitektur MVC, ada tiga komponen utama yang punya peran masing-masing, nih:

* **Model**: Bagian ini bertugas ngurusin koneksi ke database dan semua urusan query MySQL. Jadi semua data dikelola di sini.
* **View**: Ini bagian tampilan yang dilihat user. Biasanya isinya template HTML yang nanti akan diisi datanya.
* **Controller**: Fungsinya sebagai pengatur alur logika. Dia yang ngatur proses kayak CRUD dan jadi penghubung antara model sama view, semacam jembatan gitu.

Selain tiga itu, ada juga **Template**, yaitu file HTML mentah yang belum langsung ditampilkan ke browser. Template ini biasanya masih punya placeholder (kayak `STUDENT_LIST`, `KELAS_LIST`, dll) yang nantinya bakal diganti pakai data dari controller atau model.

## 3. Struktur Forlder

![image](https://github.com/user-attachments/assets/af6142df-96ed-4413-b88c-e0a7eb0134c1)

# Alur Program

Diawal pastikan dulu server Apache dan MySQL sudah aktif. Setelah itu, buka browser dan akses `index.php` lewat URL. Di halaman utamanya bakal kelihatan tampilan dengan navbar di bagian atas yang berisi tiga menu: **students**, **prestasi**, dan **akademik**. Kalau salah satu menu diklik, akan muncul data dalam bentuk tabel di mana kita bisa melakukan aksi CRUD (Create, Read, Update, Delete). Kalau mau tambah atau edit data, kita akan diarahkan ke form HTML khusus.

Untuk alur kerjanya dalam sistem MVC, misalnya kita mau menambahkan data mahasiswa:

* Saat tombol tambah diklik, URL akan berubah jadi `student.php?action=add`.
* Controller `student.controller.php` bakal mendeteksi aksi `add` tersebut dan memanggil fungsi `add`.
* Kalau form sudah disubmit, controller akan meneruskan datanya ke method `add($data)` yang ada di model `student`.
* Di bagian model inilah query untuk menyimpan data ke database dijalankan.
* Kalau penyimpanan berhasil, user akan kembali diarahkan ke halaman tabel yang berisi daftar data mahasiswa.

Proses yang sama juga berlaku untuk edit/update data. dengan urlnya `student.php?action=edit&id= idnya`

# Dokumentasi
