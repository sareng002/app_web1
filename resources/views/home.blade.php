<x-layouts.app>

    <div class="container ">
        <h1 class="text-2xl font-bold">
            Dashboard
        </h1>

        <div class="gap-4 mt-2" id="bannerGaleri">


            @if ($gambarPertama)
                {{-- Gambar Utama (Full Container) --}}
                <img id="gambarUtama" src="{{ asset('storage/' . $gambarPertama) }}" alt="Gambar Produk"
                    class="w-full h-80 object-cover rounded-lg mb-3">

                {{-- Daftar Thumbnail Kecil --}}
                <div class="flex flex-wrap gap-2 mb-3">
                    @foreach ($semuaGambar as $index => $item)
                        <img src="{{ asset('storage/' . $item) }}" alt="Thumbnail {{ $index + 1 }}"
                            data-src="{{ asset('storage/' . $item) }}"
                            class="thumb-item w-36 h-28 object-cover rounded cursor-pointer transition {{ $index === 0 ? 'ring-2 ring-blue-600 opacity-100' : 'opacity-75 hover:opacity-100' }}">
                    @endforeach
                </div>
            @endif

            <div class="container">
                <p>
                    lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quod. Lorem ipsum dolor sit amet
                    consectetur adipisicing elit. Quisquam, quod. Lorem ipsum dolor sit amet consectetur adipisicing
                    elit.
                </p>
            </div>
        </div>
    </div>



</x-layouts.app>
