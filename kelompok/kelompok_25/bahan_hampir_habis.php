<?php
// Data bahan hampir habis (simulasi dari database)
$materials = [
    [
        'id' => 1,
        'name' => 'Coklat Bubuk',
        'category' => 'Coklat',
        'current_stock' => 5,
        'min_stock' => 20,
        'unit' => 'Kg',
        'shortage' => 15,
        'estimated_days' => 3,
        'estimated_cost' => 1275000,
        'level_percentage' => 25,
        'priority' => 'TINGGI',
        'color' => 'red'
    ],
    [
        'id' => 2,
        'name' => 'Vanilla Extract',
        'category' => 'Perasa',
        'current_stock' => 2,
        'min_stock' => 10,
        'unit' => 'Botol',
        'shortage' => 8,
        'estimated_days' => 5,
        'estimated_cost' => 1200000,
        'level_percentage' => 20,
        'priority' => 'TINGGI',
        'color' => 'red'
    ],
    [
        'id' => 3,
        'name' => 'Baking Powder',
        'category' => 'Pengembang',
        'current_stock' => 8,
        'min_stock' => 25,
        'unit' => 'Kg',
        'shortage' => 17,
        'estimated_days' => 7,
        'estimated_cost' => 595000,
        'level_percentage' => 32,
        'priority' => 'SEDANG',
        'color' => 'orange'
    ],
    [
        'id' => 4,
        'name' => 'Keju Parut',
        'category' => 'Dairy',
        'current_stock' => 3,
        'min_stock' => 15,
        'unit' => 'Kg',
        'shortage' => 12,
        'estimated_days' => 4,
        'estimated_cost' => 1140000,
        'level_percentage' => 20,
        'priority' => 'TINGGI',
        'color' => 'red'
    ],
    [
        'id' => 5,
        'name' => 'Telur Ayam',
        'category' => 'Telur',
        'current_stock' => 45,
        'min_stock' => 40,
        'unit' => 'Kg',
        'shortage' => -5,
        'estimated_days' => 12,
        'estimated_cost' => -140000,
        'level_percentage' => 88,
        'priority' => 'RENDAH',
        'color' => 'yellow'
    ]
];

// Hitung statistik
$total_items = count($materials);
$high_priority = count(array_filter($materials, fn($m) => $m['priority'] === 'TINGGI'));
$medium_priority = count(array_filter($materials, fn($m) => $m['priority'] === 'SEDANG'));
$low_priority = count(array_filter($materials, fn($m) => $m['priority'] === 'RENDAH'));
$total_estimated_cost = array_sum(array_column($materials, 'estimated_cost'));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahan Hampir Habis - Inventory Manager</title>
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
                    <span class="text-sm text-gray-600">Admin User</span>
                    <span class="text-sm text-gray-500">Owner / Admin</span>
                    <div class="w-10 h-10 bg-pink-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">A</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="flex justify-between items-start mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Bahan Hampir Habis</h2>
                <p class="text-gray-600">Monitoring bahan yang perlu segera di-restock</p>
            </div>
            <div class="flex space-x-3">
                <button class="bg-orange-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-orange-600 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 0 0-15 0v5h5l-5 5-5-5h5V7a9.5 9.5 0 0 1 19 0v10z"/>
                    </svg>
                    Notifikasi Aktif
                </button>
                <button class="bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-red-700 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Export PDF
                </button>
            </div>
        </div>

        <!-- Alert Banner -->
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">
                        Peringatan: <?= $high_priority ?> Bahan Perlu Segera Direstock!
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                        <p>Beberapa bahan baku sudah mencapai atau di bawah batas minimum stok. Segera lakukan pemesanan untuk menghindari kehabisan stok.</p>
                    </div>
                    <div class="mt-3">
                        <p class="text-sm font-medium text-red-800">Estimasi Biaya Restock:</p>
                        <p class="text-lg font-bold text-red-900">Rp <?= number_format($total_estimated_cost, 0, ',', '.') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Priority Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg border border-red-200 p-6">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                    <div>
                        <p class="text-sm text-gray-600">Prioritas Tinggi</p>
                        <p class="text-2xl font-bold text-red-600"><?= $high_priority ?> Item</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg border border-orange-200 p-6">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-orange-500 rounded-full mr-3"></div>
                    <div>
                        <p class="text-sm text-gray-600">Prioritas Sedang</p>
                        <p class="text-2xl font-bold text-orange-600"><?= $medium_priority ?> Item</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg border border-yellow-200 p-6">
                <div class="flex items-center">
                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                    <div>
                        <p class="text-sm text-gray-600">Prioritas Rendah</p>
                        <p class="text-2xl font-bold text-yellow-600"><?= $low_priority ?> Item</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Materials List -->
        <div class="space-y-4">
            <?php foreach ($materials as $material): ?>
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center space-x-2 mb-1">
                                    <h3 class="text-lg font-semibold text-gray-900"><?= $material['name'] ?></h3>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full <?= $material['priority'] === 'TINGGI' ? 'bg-red-100 text-red-800' : ($material['priority'] === 'SEDANG' ? 'bg-orange-100 text-orange-800' : 'bg-yellow-100 text-yellow-800') ?>">
                                        <?= $material['priority'] ?>
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600"><?= $material['category'] ?></p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-6">
                            <div class="text-right">
                                <p class="text-sm text-gray-500">Estimasi Biaya</p>
                                <p class="text-lg font-bold <?= $material['estimated_cost'] < 0 ? 'text-green-600' : 'text-gray-900' ?>">
                                    Rp <?= number_format(abs($material['estimated_cost']), 0, ',', '.') ?>
                                </p>
                            </div>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700">
                                Buat PO
                            </button>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 md:grid-cols-5 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Stok Saat Ini</p>
                            <p class="font-semibold"><?= $material['current_stock'] ?> <?= $material['unit'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Stok Minimum</p>
                            <p class="font-semibold"><?= $material['min_stock'] ?> <?= $material['unit'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Kekurangan</p>
                            <p class="font-semibold text-red-600"><?= $material['shortage'] > 0 ? $material['shortage'] : 0 ?> <?= $material['unit'] ?></p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Estimasi Habis</p>
                            <p class="font-semibold"><?= $material['estimated_days'] ?> hari</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500 mb-2">Level Stok</p>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full <?= $material['color'] === 'red' ? 'bg-red-500' : ($material['color'] === 'orange' ? 'bg-orange-500' : 'bg-yellow-500') ?>" 
                                     style="width: <?= $material['level_percentage'] ?>%"></div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1"><?= $material['level_percentage'] ?>%</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        // Auto refresh setiap 5 menit
        setTimeout(() => {
            location.reload();
        }, 300000);

        // Notifikasi aktif toggle
        document.querySelector('.bg-orange-500').addEventListener('click', function() {
            if (this.textContent.includes('Aktif')) {
                this.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/></svg>Notifikasi Nonaktif';
                this.classList.remove('bg-orange-500', 'hover:bg-orange-600');
                this.classList.add('bg-gray-500', 'hover:bg-gray-600');
            } else {
                this.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 0 0-15 0v5h5l-5 5-5-5h5V7a9.5 9.5 0 0 1 19 0v10z"/></svg>Notifikasi Aktif';
                this.classList.remove('bg-gray-500', 'hover:bg-gray-600');
                this.classList.add('bg-orange-500', 'hover:bg-orange-600');
            }
        });

        // Export PDF functionality
        document.querySelector('.bg-red-600').addEventListener('click', function() {
            alert('Fitur export PDF akan segera tersedia');
        });
    </script>
</body>
</html>