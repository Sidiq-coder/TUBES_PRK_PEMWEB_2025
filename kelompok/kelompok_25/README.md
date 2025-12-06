Struktur Folder

src/
├─ public/                      # HANYA ini yang ke-expose ke browser
│  ├─ index.php                 # Front controller (semua request masuk sini)
│  ├─ .htaccess                 # Rewrite semua ke index.php (jika pakai Apache)
│  ├─ assets/
│  │  ├─ css/
│  │  │  └─ app.css            # Hasil build Tailwind (1 file utama)
│  │  ├─ js/
│  │  │  ├─ app.js             # JS global (navbar, notifikasi, helper)
│  │  │  └─ modules/           # JS per fitur
│  │  │     ├─ auth.js
│  │  │     ├─ materials.js
│  │  │     ├─ stock.js
│  │  │     └─ reports.js
│  │  ├─ img/                  # Icon, logo, dll (static)
│  │  └─ uploads/
│  │     └─ materials/         # Foto bahan baku (hasil upload)
│  └─ favicon.ico
│
├─ src/
│  ├─ config/
│  │  ├─ config.php            # BASE_URL, mode dev/prod, dll
│  │  └─ database.php          # Koneksi PDO
│  │
│  ├─ core/
│  │  ├─ Router.php            # Router sederhana GET/POST
│  │  ├─ Controller.php        # Base controller (render view, redirect)
│  │  ├─ Model.php             # Base model (helper query DB)
│  │  ├─ Auth.php              # Helper autentikasi (login, user saat ini)
│  │  ├─ Response.php          # Helper JSON response utk API
│  │  └─ Upload.php            # Helper upload file gambar
│  │
│  ├─ routes/
│  │  ├─ web.php               # Route untuk halaman (view HTML via PHP)
│  │  └─ api.php               # Route untuk API (JSON untuk JS/AJAX)
│  │
│  ├─ models/
│  │  ├─ User.php
│  │  ├─ Role.php
│  │  ├─ Category.php
│  │  ├─ Supplier.php
│  │  ├─ Material.php
│  │  ├─ MaterialImage.php
│  │  ├─ StockIn.php
│  │  ├─ StockOut.php
│  │  └─ StockAdjustment.php
│  │
│  ├─ controllers/
│  │  ├─ web/                  # Controller yang return VIEW
│  │  │  ├─ AuthController.php
│  │  │  ├─ DashboardController.php
│  │  │  ├─ MaterialController.php
│  │  │  ├─ SupplierController.php
│  │  │  ├─ CategoryController.php
│  │  │  ├─ StockController.php
│  │  │  └─ ReportController.php
│  │  └─ api/                  # Controller yang return JSON (dipanggil JS)
│  │     ├─ AuthApiController.php
│  │     ├─ MaterialApiController.php
│  │     ├─ StockApiController.php
│  │     └─ ReportApiController.php
│  │
│  ├─ views/
│  │  ├─ layouts/
│  │  │  ├─ main.php           # Layout utama (navbar + sidebar)
│  │  │  └─ auth.php           # Layout khusus login/register (tanpa sidebar)
│  │  ├─ partials/
│  │  │  ├─ navbar.php
│  │  │  └─ sidebar.php
│  │  ├─ auth/
│  │  │  ├─ login.php
│  │  │  └─ register.php
│  │  ├─ dashboard/
│  │  │  └─ index.php
│  │  ├─ materials/
│  │  │  ├─ index.php          # Tabel bahan + foto
│  │  │  ├─ form.php           # Form create/edit (bisa dipakai reuse)
│  │  ├─ suppliers/
│  │  ├─ categories/
│  │  ├─ stock_in/
│  │  ├─ stock_out/
│  │  ├─ stock_adjustments/
│  │  └─ reports/
│  │     ├─ stock.php
│  │     ├─ transactions.php
│  │     └─ low_stock.php
│  │
│  ├─ middleware/
│  │  ├─ AuthMiddleware.php    # Cek sudah login
│  │  └─ RoleMiddleware.php    # Cek role tertentu
│  │
│  └─ helpers/
│     ├─ functions.php         # Helper umum: redirect(), url(), csrf_token(), dll
│     └─ validation.php        # Helper validasi form
│
├─ tailwind.config.js
├─ package.json                # Kalau pakai npm utk build Tailwind
└─ README.md
