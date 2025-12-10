<?php
$user = current_user();
?>

<nav class="bg-white border-b border-slate-200 h-16 flex items-center px-6 justify-between shadow-sm">
    <div class="flex items-center gap-3">
        <div class="h-10 w-10 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-semibold">IM</div>
        <div>
            <p class="text-sm font-semibold text-slate-700">Inventory Manager</p>
            <p class="text-xs text-slate-500">Sistem Manajemen Stok Bahan Baku</p>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <div class="text-right">
            <p class="text-sm font-semibold text-slate-700"><?= e($user['name'] ?? 'User') ?></p>
            <p class="text-xs text-slate-500"><?= e($user['role_name'] ?? 'Staff') ?></p>
        </div>
        <div class="relative">
            <button class="h-10 w-10 rounded-full bg-purple-500 text-white flex items-center justify-center font-semibold hover:bg-purple-600" onclick="toggleDropdown()">
                <?= strtoupper(substr($user['name'] ?? 'U', 0, 1)) ?>
            </button>
            <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                <a href="../../../profil.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                <a href="<?= url('/logout') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
            </div>
        </div>
    </div>
</nav>

<script>
function toggleDropdown() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('hidden');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const button = event.target.closest('button');
    
    if (!button || !button.onclick) {
        dropdown.classList.add('hidden');
    }
});
</script>
