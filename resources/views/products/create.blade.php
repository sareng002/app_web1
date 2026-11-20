<x-layouts.app>



    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">

        <h1 class="text-2xl font-bold mb-4">
            Tambah Produk
        </h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block mb-1">
                    Nama Produk
                </label>

                <input type="text" name="nama" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1">
                    Stok
                </label>

                <input type="number" name="stok" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1">
                    Harga
                </label>

                <input type="number" name="harga" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1">
                    Gambar
                </label>

                <input type="file" name="gambar" class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Simpan
            </button>
        </form>

    </div>



</x-layouts.app>
