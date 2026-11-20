<x-layouts.app>

    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">

        <h1 class="text-2xl font-bold mb-4">
            Edit Produk
        </h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')


            <div class="mb-4">
                <label class="block mb-1">
                    Nama Produk
                </label>

                <input type="text" name="nama" value="{{ $product->nama }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1">
                    Stok
                </label>

                <input type="number" name="stok" value="{{ $product->stok }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1">
                    Harga
                </label>

                <input type="number" name="harga" value="{{ $product->harga }}"
                    class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1">
                    Gambar
                </label>

                <input type="file" name="gambar" class="w-full border rounded px-3 py-2">
                @if ($product->gambar)
                    <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->nama }}"
                        class="w-16 h-16 object-cover mt-2">
                @endif



            </div>


            <button type="submit" class="border-2 bg-yellow-500 text-gr px-4 py-2 rounded">
                Update
            </button>

        </form>

    </div>

</x-layouts.app>
