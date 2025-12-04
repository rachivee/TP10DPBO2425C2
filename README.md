# TP10DPBO2425C2

Saya Farah Maulida dengan NIM 2410024 mengerjakan Tugas Praktikum 10 dalam mata kuliah Desain dan Pemrograman Berbasis Objek untuk keberkahan-Nya maka saya tidak akan melakukan kecurangan seperti yang telah di spesifikasikan Aamiin.

## Deskripsi Proyek
**BudgetTracker** adalah aplikasi berbasis web sederhana yang dibangun menggunakan bahasa pemrograman PHP dengan pola arsitektur MVVM (Model-View-ViewModel). Aplikasi ini dirancang untuk membantu pengguna, khususnya mahasiswa atau anak kost, dalam mengelola keuangan pribadi mereka. Pengguna dapat mencatat pemasukan dan pengeluaran, mengelola berbagai dompet (sumber dana), serta menetapkan anggaran (budgeting) bulanan untuk menjaga kesehatan finansial.

---

# Desain Program

Aplikasi ini menerapkan konsep Pemrograman Berorientasi Objek (OOP) dan memisahkan logika aplikasi ke dalam beberapa lapisan (Layered Architecture):

### 1. Arsitektur MVVM (Model-View-ViewModel)
* **Model (`models/`)**: Bertanggung jawab untuk berinteraksi langsung dengan database. Berisi *query* SQL untuk operasi CRUD (Create, Read, Update, Delete) dan logika perhitungan data di level database (seperti menghitung sisa budget menggunakan *subquery*).
    * `Transaction.php`, `Wallet.php`, `Category.php`, `Budget.php`.
* **View (`views/`)**: Bertanggung jawab untuk menampilkan antarmuka pengguna (UI). File ini berisi HTML yang dipadukan dengan PHP untuk menampilkan data, serta menggunakan **Bootstrap 5** untuk *styling*.
    * Folder ini berisi form input, tabel daftar data, dan dashboard.
* **ViewModel (`viewmodels/`)**: Bertindak sebagai perantara antara Model dan View (via Controller). ViewModel memproses data dari Model agar siap ditampilkan oleh View, atau menerima input dari Controller untuk diteruskan ke Model.
    * `TransactionViewModel.php`, `WalletViewModel.php`, dll.

### 2. Struktur Database
Database `budget_tracker` terdiri dari 4 tabel yang saling berelasi:
* **wallets**: Menyimpan data sumber dana (misal: Cash, BCA, Gopay).
* **categories**: Menyimpan jenis transaksi (Income/Expense).
* **transactions**: Tabel utama yang mencatat arus uang, berelasi dengan `wallets` dan `categories`.
* **budgets**: Menyimpan batas pengeluaran per kategori per bulan.

---

# Fitur Utama

1.  **Dashboard Interaktif**:
    * Menampilkan total kekayaan (*Net Worth*) secara *real-time* (akumulasi semua saldo dompet).
    * Ringkasan Pemasukan dan Pengeluaran bulan ini.
    * Daftar 5 transaksi terakhir.
2.  **Manajemen Dompet (Wallet)**:
    * Menambah, mengedit, dan menghapus dompet.
    * Menampilkan saldo awal dan saldo saat ini (dihitung otomatis berdasarkan transaksi).
3.  **Pencatatan Transaksi**:
    * Mencatat Pemasukan dan Pengeluaran.
    * Otomatis mengurangi/menambah saldo dompet terkait.
    * Visualisasi warna (Merah untuk pengeluaran, Hijau untuk pemasukan).
4.  **Sistem Budgeting Cerdas**:
    * Menetapkan batas pengeluaran per kategori per bulan.
    * **Progress Bar Visual**: Menampilkan persentase pemakaian anggaran.
    * **Warning System**: Memberikan indikator warna (Hijau: Aman, Kuning: Hampir Habis, Merah: Over Budget).
5.  **Kategori Kustom**: Pengguna dapat membuat kategori pengeluaran/pemasukan sendiri beserta ikonnya.

---

# Alur Program

Aplikasi ini menggunakan `index.php` sebagai *entry point* (Controller utama) yang menangani *routing*:

1.  **Request**: Pengguna mengakses URL, misal `index.php?entity=transaction&action=add`.
2.  **Routing**:
    * `index.php` membaca parameter `entity` (objek yang dituju) dan `action` (aksi yang diinginkan).
    * Berdasarkan entity, Controller menginisialisasi `ViewModel` yang sesuai.
3.  **Proses**:
    * Jika action adalah `list`, ViewModel mengambil data dari Model, lalu View ditampilkan.
    * Jika action adalah `save` atau `update`, Controller mengambil data dari `$_POST`, mengirimnya ke ViewModel -> Model untuk disimpan ke Database, lalu me-*redirect* kembali ke halaman list.
4.  **Response**: Server mengirimkan file View (HTML/PHP) yang sudah berisi data untuk ditampilkan di browser pengguna.

# Dokumentasi
