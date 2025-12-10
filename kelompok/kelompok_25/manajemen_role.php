<?php
// Data roles (simulasi dari database)
$roles = [
    [
        'id' => 1,
        'name' => 'Owner / Admin',
        'description' => 'Akses penuh ke seluruh sistem',
        'user_count' => 2,
        'permissions' => ['Dashboard', 'Data Bahan Baku', 'Data Supplier', 'Data Kategori'],
        'color' => 'bg-gradient-to-r from-purple-500 to-pink-500'
    ],
    [
        'id' => 2,
        'name' => 'Staff Gudang',
        'description' => 'Kelola stok masuk, keluar, dan penyesuaian',
        'user_count' => 5,
        'permissions' => ['Dashboard', 'Data Bahan Baku', 'Stok Masuk', 'Stok Keluar'],
        'color' => 'bg-gradient-to-r from-blue-500 to-cyan-500'
    ],
    [
        'id' => 3,
        'name' => 'Keuangan',
        'description' => 'Akses ke laporan dan data keuangan',
        'user_count' => 3,
        'permissions' => ['Dashboard', 'Data Bahan Baku', 'Data Supplier', 'Stok Masuk'],
        'color' => 'bg-gradient-to-r from-green-500 to-emerald-500'
    ]
];

// Data users (simulasi dari database)
$users = [
    ['id' => 1, 'name' => 'Admin User', 'email' => 'admin@inventory.com', 'phone' => '0812-3456-7890', 'role' => 'Owner / Admin', 'status' => 'active', 'last_login' => '2025-11-30 10:30'],
    ['id' => 2, 'name' => 'Budi Santoso', 'email' => 'budi@inventory.com', 'phone' => '0813-4567-8901', 'role' => 'Owner / Admin', 'status' => 'active', 'last_login' => '2025-11-30 08:15'],
    ['id' => 3, 'name' => 'Siti Aminah', 'email' => 'siti@inventory.com', 'phone' => '0814-5678-9012', 'role' => 'Staff Gudang', 'status' => 'active', 'last_login' => '2025-11-29 16:45'],
    ['id' => 4, 'name' => 'Ahmad Yani', 'email' => 'ahmad@inventory.com', 'phone' => '0815-6789-0123', 'role' => 'Staff Gudang', 'status' => 'active', 'last_login' => '2025-11-30 09:20'],
    ['id' => 5, 'name' => 'Rina Dewi', 'email' => 'rina@inventory.com', 'phone' => '0816-7890-1234', 'role' => 'Keuangan', 'status' => 'active', 'last_login' => '2025-11-29 14:30'],
    ['id' => 6, 'name' => 'Joko Widodo', 'email' => 'joko@inventory.com', 'phone' => '0817-8901-2345', 'role' => 'Staff Gudang', 'status' => 'inactive', 'last_login' => '2025-11-25 11:00']
];

$currentView = $_GET['view'] ?? 'roles';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Role & Hak Akses - Inventory Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-200 min-h-screen">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-semibold text-gray-900">Inventory Manager</h1>
                        <p class="text-sm text-gray-500">Sistem Manajemen Stok Bahan Baku</p>
                    </div>
                </div>
            </div>

            <nav class="p-4 space-y-2">
                <a href="src/public/" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                <div class="space-y-1">
                    <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Data Master</p>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>Bahan Baku</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                        </svg>
                        <span>Supplier</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span>Kategori</span>
                    </a>
                </div>

                <div class="space-y-1">
                    <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Transaksi Stock</p>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Stok Masuk</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                        </svg>
                        <span>Stok Keluar</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Penyesuaian Stok</span>
                    </a>
                </div>

                <div class="space-y-1">
                    <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wide">Laporan</p>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Laporan Stok</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Laporan Transaksi</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span>Bahan Hampir Habis</span>
                    </a>
                </div>

                <a href="?view=roles" class="flex items-center space-x-3 px-3 py-2 rounded-lg bg-blue-100 text-blue-700 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                    <span>Manajemen Role</span>
                </a>

                <a href="profil.php" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Profil Saya</span>
                </a>

                <a href="logout.php" class="flex items-center space-x-3 px-3 py-2 rounded-lg text-red-600 hover:bg-red-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Logout</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            <!-- Header -->
            <div class="bg-white shadow-sm border-b">
                <div class="px-6 py-4 flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Manajemen Role & Hak Akses</h1>
                            <p class="text-gray-600">Kelola peran pengguna dan izin akses sistem</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">Admin User</span>
                        <span class="text-sm text-gray-500">Owner / Admin</span>
                        <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold">A</span>
                        </div>
                        <button class="bg-purple-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-purple-700 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Tambah Role
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <?php if ($currentView === 'roles'): ?>
                    <!-- Tab Navigation for Roles View -->
                    <div class="bg-white rounded-2xl shadow-sm mb-6">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex space-x-8">
                                <a href="?view=roles" class="pb-2 border-b-2 border-blue-500 text-blue-600 font-medium">Roles</a>
                                <a href="?view=users" class="pb-2 border-b-2 border-transparent text-gray-500 hover:text-gray-700">Users</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Roles View -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($roles as $role): ?>
                            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                                <div class="<?= $role['color'] ?> p-6 text-white">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                        </div>
                                        <div class="flex space-x-2">
                                            <div class="w-6 h-6 bg-white bg-opacity-30 rounded"></div>
                                            <div class="w-6 h-6 bg-white bg-opacity-30 rounded"></div>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-bold"><?= $role['name'] ?></h3>
                                </div>
                                
                                <div class="p-6">
                                    <p class="text-gray-600 mb-4"><?= $role['description'] ?></p>
                                    
                                    <div class="flex items-center text-gray-500 mb-4">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span><?= $role['user_count'] ?> User</span>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <p class="text-sm font-medium text-gray-700 mb-2">Izin Akses:</p>
                                        <div class="flex flex-wrap gap-2">
                                            <?php foreach (array_slice($role['permissions'], 0, 2) as $permission): ?>
                                                <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded"><?= $permission ?></span>
                                            <?php endforeach; ?>
                                            <?php if (count($role['permissions']) > 2): ?>
                                                <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded">+<?= count($role['permissions']) - 2 ?> lainnya</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php else: ?>
                    <!-- Users View -->
                    <div class="bg-white rounded-2xl shadow-sm">
                        <div class="p-6 border-b border-gray-200">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex space-x-8">
                                    <a href="?view=roles" class="pb-2 border-b-2 border-transparent text-gray-500 hover:text-gray-700">Roles</a>
                                    <a href="?view=users" class="pb-2 border-b-2 border-blue-500 text-blue-600 font-medium">Users</a>
                                </div>
                                <button class="bg-purple-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-purple-700 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah User
                                </button>
                            </div>
                            
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" placeholder="Cari user..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-full max-w-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <?php foreach ($users as $user): ?>
                                    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                                        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 p-6 text-white">
                                            <div class="flex justify-between items-start mb-4">
                                                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                                <div class="flex space-x-2">
                                                    <div class="w-6 h-6 bg-white bg-opacity-30 rounded"></div>
                                                    <div class="w-6 h-6 bg-white bg-opacity-30 rounded"></div>
                                                </div>
                                            </div>
                                            <h3 class="text-xl font-bold"><?= $user['name'] ?></h3>
                                        </div>
                                        
                                        <div class="p-6">
                                            <p class="text-gray-600 mb-2"><?= $user['email'] ?></p>
                                            
                                            <div class="flex items-center text-gray-500 mb-4">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                                <span><?= $user['phone'] ?></span>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500">Role:</p>
                                                <p class="font-medium text-gray-700"><?= $user['role'] ?></p>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <p class="text-sm text-gray-500">Status:</p>
                                                <span class="inline-block px-2 py-1 text-xs rounded-full <?= $user['status'] === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                    <?= $user['status'] ?>
                                                </span>
                                            </div>
                                            
                                            <div>
                                                <p class="text-sm text-gray-500">Last Login:</p>
                                                <p class="text-sm text-gray-700"><?= date('Y-m-d H:i', strtotime($user['last_login'])) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const view = urlParams.get('view') || 'roles';
            
            // Update active tab styling
            const tabs = document.querySelectorAll('a[href*="view="]');
            tabs.forEach(tab => {
                if (tab.href.includes(`view=${view}`)) {
                    tab.classList.add('border-blue-500', 'text-blue-600', 'font-medium');
                    tab.classList.remove('border-transparent', 'text-gray-500');
                } else {
                    tab.classList.add('border-transparent', 'text-gray-500');
                    tab.classList.remove('border-blue-500', 'text-blue-600', 'font-medium');
                }
            });
        });
    </script>
</body>
</html>