<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#eef2f7]">

    <!-- Header -->
    <div class="w-full bg-[#3157ff] text-white rounded-b-2xl shadow-lg p-8">
        <div class="max-w-5xl mx-auto flex items-center gap-6">

            <!-- Avatar -->
            <div class="w-24 h-24 rounded-full bg-white flex items-center justify-center text-[#3157ff] text-3xl font-bold">
                A
            </div>

            <!-- Info -->
            <div class="flex-1">
                <div class="text-lg font-semibold">Admin User</div>
                <div class="opacity-90">scss2wfgcgf@gjsdjs.ck</div>
                <div class="mt-1 text-sm opacity-80 bg-white/20 w-fit px-3 py-1 rounded">
                    Bergabung sejak 15 Januari 2024
                </div>
            </div>

        </div>
    </div>

    <!-- Content Section -->
    <div class="max-w-5xl mx-auto mt-6 bg-white p-6 rounded-xl shadow">

        <!-- Tabs -->
        <div class="border-b mb-6 flex gap-6">
            <button class="text-[#3157ff] font-medium pb-2 border-b-2 border-[#3157ff]">Edit Profil</button>
            <button class="text-gray-500 pb-2">Ganti Password</button>
            <button class="text-gray-500 pb-2">Aktivitas Log</button>
        </div>

        <!-- Form -->
        <form class="space-y-6">

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                    <input type="text" value="Admin User"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#3157ff] focus:outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" value="scss2wfgcgf@gjsdjs.ck"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#3157ff] focus:outline-none">
                </div>

                <!-- Telepon -->
                <div>
                    <label class="block text-sm font-medium mb-1">No. Telepon</label>
                    <input type="text" value="0812-3456-7890"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#3157ff] focus:outline-none">
                </div>

                <!-- Perusahaan -->
                <div>
                    <label class="block text-sm font-medium mb-1">Perusahaan</label>
                    <input type="text" value="PT Inventory Sejahtera"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#3157ff] focus:outline-none">
                </div>

            </div>

            <!-- Alamat -->
            <div>
                <label class="block text-sm font-medium mb-1">Alamat</label>
                <textarea rows="4"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#3157ff] focus:outline-none"></textarea>
            </div>

            <!-- Save Button -->
            <button type="submit"
                class="px-6 py-3 bg-[#3157ff] hover:bg-[#1e3de0] text-white font-medium rounded-lg shadow">
                Simpan Perubahan
            </button>

        </form>

    </div>

</body>
</html>
