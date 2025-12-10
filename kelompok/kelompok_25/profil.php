<?php
// Data user (simulasi dari database)
$user = [
    'name' => 'Admin User',
    'email' => 'scss2wfgcgf@gjsdjs.ck',
    'phone' => '0812-3456-7890',
    'company' => 'PT Inventory Sejahtera',
    'address' => '',
    'created_at' => '2024-01-15'
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Inventory Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-4">
                    <button class="p-2 rounded-md hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
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
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600"><?= $user['name'] ?></span>
                    <span class="text-sm text-gray-500">Owner / Admin</span>
                    <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold"><?= strtoupper(substr($user['name'], 0, 1)) ?></span>
                    </div>
                    <a href="src/public/" class="text-sm text-blue-600 hover:text-blue-700">Dashboard</a>
                    <a href="logout.php" class="text-sm text-red-600 hover:text-red-700">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Profil Saya</h2>
            <p class="text-gray-600">Kelola informasi akun dan keamanan Anda</p>
        </div>

        <!-- Profile Card -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-3xl p-8 mb-8 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-6">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center">
                        <span class="text-3xl font-bold text-blue-600"><?= strtoupper(substr($user['name'], 0, 1)) ?></span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold mb-1"><?= $user['name'] ?></h3>
                        <p class="text-blue-100 mb-2"><?= $user['email'] ?></p>
                        <div class="inline-block bg-white bg-opacity-20 px-3 py-1 rounded-full text-sm">
                            Status: Aktif
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-blue-100 mb-1">Bergabung sejak</p>
                    <p class="text-xl font-semibold"><?= date('d F Y', strtotime($user['created_at'])) ?></p>
                </div>
            </div>
        </div>

        <!-- Profile Tabs -->
        <div class="bg-white rounded-2xl shadow-sm">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-8 pt-6">
                    <button class="profile-tab active pb-4 px-1 border-b-2 border-blue-500 font-medium text-blue-600 text-sm flex items-center" data-tab="edit">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Edit Profil
                    </button>
                    <button class="profile-tab pb-4 px-1 border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700 text-sm flex items-center" data-tab="password">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Ganti Password
                    </button>
                    <button class="profile-tab pb-4 px-1 border-b-2 border-transparent font-medium text-gray-500 hover:text-gray-700 text-sm flex items-center" data-tab="activity">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Aktivitas Log
                    </button>
                </nav>
            </div>

            <div class="p-8">
                <!-- Edit Profile Tab -->
                <div id="edit-tab" class="tab-content">
                    <form method="POST" action="" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap -->
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Nama Lengkap
                                </label>
                                <input type="text" name="name" value="<?= $user['name'] ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    Email
                                </label>
                                <input type="email" name="email" value="<?= $user['email'] ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- No. Telepon -->
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    No. Telepon
                                </label>
                                <input type="tel" name="phone" value="<?= $user['phone'] ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>

                            <!-- Perusahaan -->
                            <div>
                                <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    Perusahaan
                                </label>
                                <input type="text" name="company" value="<?= $user['company'] ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                Alamat
                            </label>
                            <textarea name="address" rows="3" placeholder="Masukkan alamat lengkap..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"><?= $user['address'] ?></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" name="update_profile" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password Tab -->
                <div id="password-tab" class="tab-content hidden">
                    <form method="POST" action="" class="space-y-6 max-w-md">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                            <input type="password" name="current_password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                            <input type="password" name="new_password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="confirm_password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <button type="submit" name="update_password" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                            Update Password
                        </button>
                    </form>
                </div>

                <!-- Activity Log Tab -->
                <div id="activity-tab" class="tab-content hidden">
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-4"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Login berhasil</p>
                                <p class="text-xs text-gray-500">Hari ini, 10:30 AM</p>
                            </div>
                        </div>
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-4"></div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">Profil diperbarui</p>
                                <p class="text-xs text-gray-500">Kemarin, 2:15 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.profile-tab');
            const contents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.dataset.tab;
                    
                    tabs.forEach(t => {
                        t.classList.remove('active', 'border-blue-500', 'text-blue-600');
                        t.classList.add('border-transparent', 'text-gray-500');
                    });
                    
                    this.classList.add('active', 'border-blue-500', 'text-blue-600');
                    this.classList.remove('border-transparent', 'text-gray-500');
                    
                    contents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    document.getElementById(targetTab + '-tab').classList.remove('hidden');
                });
            });
        });
    </script>
</body>
</html>

<?php
// Handle form submissions
if ($_POST) {
    if (isset($_POST['update_profile'])) {
        // Update profile logic here
        echo "<script>alert('Profil berhasil diperbarui!');</script>";
    }
    
    if (isset($_POST['update_password'])) {
        // Update password logic here
        echo "<script>alert('Password berhasil diperbarui!');</script>";
    }
}
?>