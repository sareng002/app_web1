<x-layouts.app>

    <div class="container mx-auto mt-0">

        <div class="">


            <div class="bg-indigo-600 p-2 uppercase text-amber-50 font-semibold rounded-lg mb-1">

                <p class="ml-4">
                    {{ $title }}

                </p>
                <p class="ml-4">
                    total product :{{ $total }}
                </p>

            </div>
            <div class="mt-4 bg-indigo-500 rounded-lg ">
                <form method="GET" action="/products">

                    <button class="p-4 uppercase text-amber-100 font-semibold" type="submit">
                        Cari
                    </button>

                    <input class="p-2 mr-2 text-gray-800 border-2 bg-gray-100 rounded-lg border-gray-300 w-2/4 "
                        type="text" name="search" placeholder="Cari produk..." id="search"
                        value="{{ request('search') }}">

                    <a class="p-2 ml-3 bg-green-500 text-white rounded-lg" href="{{ route('products.create') }}">
                        Tambah Produk
                    </a>


                </form>
            </div>
            <div class="p-4 mt-2 bg-indigo-400 rounded-lg capitalize">

                @if (session('success'))
                    <div style="background:green;padding:10px;color:white">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full">
                    <thead>
                        <tr class="bg-red-200 uppercase">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Nama</th>
                            <th class="border p-2">Harga</th>
                            <th class="border p-2">Stok</th>
                            <th class="border p-2">Gambar</th>
                            <th class="border p-2">aksi</th>
                        </tr>
                    </thead>

                    <tbody id="product-table">

                        @foreach ($products as $product)
                            <tr>
                                <td class="border p-1">{{ $product->id }}</td>
                                <td class="border p-1">{{ $product->nama }}</td>
                                <td class="border p-1">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                </td>
                                <td class="border p-2">
                                    {{ $product->stok }}
                                </td>
                                <td class="border p-2">
                                    <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->nama }}"
                                        class="w-16 h-16 object-cover">
                                </td>

                                <td class="border p-1 gap-4 flex">
                                    <a class="p-2 text-sm bg-yellow-500 text-white rounded-lg"
                                        href="{{ route('products.edit', $product->id) }}">
                                        edit
                                    </a>

                                    <form id="delete-form-{{ $product->id }}"
                                        action="{{ route('products.destroy', $product->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="confirmDelete({{ $product->id }})"
                                            class="p-2 text-sm bg-red-500 text-white rounded-lg">
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>




</x-layouts.app>
