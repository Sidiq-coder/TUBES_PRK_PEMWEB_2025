<div class="p-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Role & Hak Akses</h1>
            <p class="text-gray-600 mt-1">Kelola peran pengguna dan izin akses sistem</p>
        </div>
        <button id="addRoleBtn" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Tambah Role
        </button>
    </div>

    <!-- Tabs -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            <button class="tab-btn active border-b-2 border-purple-500 py-2 px-1 text-sm font-medium text-purple-600" data-tab="roles">
                Roles
            </button>
            <button class="tab-btn border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="users">
                Users
            </button>
        </nav>
    </div>

    <!-- Roles Tab Content -->
    <div id="roles-tab" class="tab-content">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($roles as $role): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <!-- Role Header -->
                    <div class="p-6 <?= getRoleColor($role['code']) ?>">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-white font-semibold text-lg"><?= e($role['name']) ?></h3>
                                </div>
                            </div>
                            <div class="flex gap-1">
                                <?php for ($i = 0; $i < 2; $i++): ?>
                                    <div class="w-6 h-6 bg-white bg-opacity-30 rounded"></div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Role Content -->
                    <div class="p-6">
                        <p class="text-gray-600 text-sm mb-4"><?= e($role['description'] ?: 'Akses ke sistem sesuai dengan peran yang diberikan') ?></p>
                        
                        <div class="flex items-center gap-2 text-gray-500 text-sm mb-4">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                            </svg>
                            <span><?= $role['user_count'] ?></span>
                            <span>User</span>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700 mb-2">Izin Akses:</p>
                            <div class="flex flex-wrap gap-2">
                                <?php 
                                $permissions = explode(', ', $role['permissions'] ?: '');
                                $displayPermissions = array_slice($permissions, 0, 2);
                                $remainingCount = count($permissions) - 2;
                                ?>
                                <?php foreach ($displayPermissions as $permission): ?>
                                    <?php if (!empty(trim($permission))): ?>
                                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded"><?= e($permission) ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if ($remainingCount > 0): ?>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded">+<?= $remainingCount ?> lainnya</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Users Tab Content -->
    <div id="users-tab" class="tab-content hidden">
        <div class="flex justify-between items-center mb-6">
            <div class="relative">
                <input type="text" id="userSearch" placeholder="Cari user..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <button id="addUserBtn" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah User
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="usersGrid">
            <?php foreach ($users as $user): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden user-card" data-name="<?= strtolower(e($user['name'])) ?>" data-email="<?= strtolower(e($user['email'])) ?>">
                    <!-- User Header -->
                    <div class="p-6 bg-gradient-to-r from-blue-500 to-blue-600">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-white font-semibold text-lg"><?= e($user['name']) ?></h3>
                                </div>
                            </div>
                            <div class="flex gap-1">
                                <div class="w-6 h-6 bg-white bg-opacity-30 rounded"></div>
                                <div class="w-6 h-6 bg-white bg-opacity-30 rounded"></div>
                            </div>
                        </div>
                    </div>

                    <!-- User Content -->
                    <div class="p-6">
                        <p class="text-gray-600 text-sm mb-2"><?= e($user['email']) ?></p>
                        <?php if ($user['phone']): ?>
                            <div class="flex items-center gap-2 text-gray-500 text-sm mb-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span><?= e($user['phone']) ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700 mb-1">Role:</p>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-sm rounded"><?= e($user['role_name'] ?: 'Tidak ada role') ?></span>
                        </div>

                        <div class="mb-4">
                            <p class="text-sm font-medium text-gray-700 mb-1">Status:</p>
                            <span class="px-2 py-1 text-sm rounded <?= $user['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                <?= $user['is_active'] ? 'active' : 'inactive' ?>
                            </span>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">Last Login:</p>
                            <p class="text-sm text-gray-500"><?= $user['updated_at'] ? date('Y-m-d H:i', strtotime($user['updated_at'])) : 'Belum pernah login' ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Add Role Modal -->
<div id="addRoleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
        <h3 class="text-lg font-semibold mb-4">Tambah Role Baru</h3>
        <form action="<?= url('/roles/create') ?>" method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Role</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Kode Role</label>
                <input type="text" name="code" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" id="cancelRoleBtn" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
        <h3 class="text-lg font-semibold mb-4">Tambah User Baru</h3>
        <form action="<?= url('/roles/create-user') ?>" method="POST">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                <input type="text" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <select name="role_id" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">Pilih Role</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id'] ?>"><?= e($role['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex gap-3">
                <button type="button" id="cancelUserBtn" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const tabName = btn.dataset.tab;
            
            // Update tab buttons
            tabBtns.forEach(b => {
                b.classList.remove('active', 'border-purple-500', 'text-purple-600');
                b.classList.add('border-transparent', 'text-gray-500');
            });
            btn.classList.add('active', 'border-purple-500', 'text-purple-600');
            btn.classList.remove('border-transparent', 'text-gray-500');
            
            // Update tab content
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });
            document.getElementById(tabName + '-tab').classList.remove('hidden');
        });
    });
    
    // Modal handling
    const addRoleBtn = document.getElementById('addRoleBtn');
    const addRoleModal = document.getElementById('addRoleModal');
    const cancelRoleBtn = document.getElementById('cancelRoleBtn');
    
    const addUserBtn = document.getElementById('addUserBtn');
    const addUserModal = document.getElementById('addUserModal');
    const cancelUserBtn = document.getElementById('cancelUserBtn');
    
    addRoleBtn.addEventListener('click', () => {
        addRoleModal.classList.remove('hidden');
        addRoleModal.classList.add('flex');
    });
    
    cancelRoleBtn.addEventListener('click', () => {
        addRoleModal.classList.add('hidden');
        addRoleModal.classList.remove('flex');
    });
    
    addUserBtn.addEventListener('click', () => {
        addUserModal.classList.remove('hidden');
        addUserModal.classList.add('flex');
    });
    
    cancelUserBtn.addEventListener('click', () => {
        addUserModal.classList.add('hidden');
        addUserModal.classList.remove('flex');
    });
    
    // User search
    const userSearch = document.getElementById('userSearch');
    const userCards = document.querySelectorAll('.user-card');
    
    userSearch.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();
        
        userCards.forEach(card => {
            const name = card.dataset.name;
            const email = card.dataset.email;
            
            if (name.includes(searchTerm) || email.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
    
    // Close modals when clicking outside
    [addRoleModal, addUserModal].forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    });
});
</script>

<?php
function getRoleColor($roleCode) {
    $colors = [
        'admin' => 'bg-gradient-to-r from-purple-500 to-pink-500',
        'manager' => 'bg-gradient-to-r from-blue-500 to-blue-600',
        'staff' => 'bg-gradient-to-r from-green-500 to-green-600',
    ];
    
    return $colors[$roleCode] ?? 'bg-gradient-to-r from-gray-500 to-gray-600';
}
?>