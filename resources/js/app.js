
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;
Alpine.start();

window.Swal = Swal;


const swalSuccess =
    document.getElementById('swal-success');

if (swalSuccess) {

    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: swalSuccess.dataset.message,
        timer: 2000,
        showConfirmButton: false
    });

}



// kode untuk menangani event keyup pada input pencarian

const searchInput = document.getElementById('search');


// ajax search
if (searchInput) {

  searchInput.addEventListener('keyup', async function() {

    //console.log(this.value)
    //document.title = this.value;
    //document.getElementById('judul').innerText = this.value;
   // window.location.href = '/produk?search=' + this.value;

    //const keyword = this.value;

    //const response = await fetch(
        //'/ajax-search?search=' + keyword
    //);

    //const data = await response.json();

    //console.log(data);

    const keyword = this.value;
        if(keyword.trim() === '')
            {
                window.location.href = '/products';
                return;
            }

        const response = await fetch(
            '/ajax-search?search=' + keyword
        );

        const products = await response.json();

        let html = ''; products.forEach(product => {

    html += `
                <tr>

                    <td class="border p-2">
                        ${product.id}
                    </td>

                    <td class="border p-2">
                        ${product.nama}
                    </td>

                    <td class="border p-2">
                        ${product.harga}
                    </td>

                    <td class="border p-2">
                        ${product.stok}
                    </td>

                    <td class="border p-2">
                        ${product.gambar ? `<img src="/storage/${product.gambar}" alt="${product.nama}" class="w-16 h-16 object-cover rounded">` : 'Tidak ada gambar'}
                    </td>

                    <td class="border p-2">
                        <div class="gap-4 flex">
                            <a class="w-20 flex p-2 bg-yellow-500 text-white rounded-lg"
                                href="/products/${product.id}/edit">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="m17.71 7.29-3-3a.996.996 0 0 0-1.41 0l-11.01 11A1 1 0 0 0 2 16v3c0 .55.45 1 1 1h3c.27 0 .52-.11.71-.29l11-11a.996.996 0 0 0 0-1.41ZM5.59 18H4v-1.59l7.5-7.5 1.59 1.59zm8.91-8.91L12.91 7.5 14 6.41 15.59 8zM11 18h11v2H11z">
                                    </path>
                                </svg>

                                <p
                                    class="align-middle text-center">
                                    Edit
                                </p>

                            </a>

                            <form
                                id="delete-form-${product.id}"
                                action="/products/${product.id}"
                                method="POST"
                                style="display:inline">

                                    <input
                                    type="hidden"
                                    name="_token"
                                    value="${document.querySelector('meta[name="csrf-token"]').content}">

                                <input
                                    type="hidden"
                                    name="_method"
                                    value="DELETE">

                                <button
                                    type="button"
                                    onclick="confirmDelete(${product.id})"
                                    class="w-20 flex p-2 bg-red-500 text-white rounded-lg">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <!--Boxicons v3.0.8 https://boxicons.com | License  https://docs.boxicons.com/free-->
                                            <path
                                                d="M17 6V4c0-1.1-.9-2-2-2H9c-1.1 0-2 .9-2 2v2H2v2h2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8h2V6zM9 4h6v2H9zm9 16H6V8h12z">
                                            </path>
                                            <path
                                                d="M14.29 10.29 12 12.59l-2.29-2.3-1.42 1.42 2.3 2.29-2.3 2.29 1.42 1.42 2.29-2.3 2.29 2.3 1.42-1.42-2.3-2.29 2.3-2.29z">
                                            </path>
                                        </svg>
                                    <p class="align-middle text-center">
                                        Hapus
                                    </p>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
    `;


        });
console.log(html);
        document.getElementById('product-table') .innerHTML = html;
});

}

// SweetAlert2

window.confirmDelete = function(id)
{
    Swal.fire({
        title: 'Yakin?',
        text: 'Data produk akan dihapus!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {

        if (result.isConfirmed) {

            document
                .getElementById('delete-form-' + id)
                .submit();

        }

    });
};


// pemerosesan galeri banner di halaman home
document.addEventListener('DOMContentLoaded', function() {
    const galeri = document.getElementById('bannerGaleri');
    const gambarUtama = document.getElementById('gambarUtama');
    const thumbs = Array.from(document.querySelectorAll('.thumb-item'));

    if (!galeri || !gambarUtama || thumbs.length <= 1) return;

    let currentIndex = 0;
    let intervalId = null;
    const delayMs = 5000; // ganti gambar setiap 5 detik

    function setActiveSlide(index) {
        currentIndex = ((index % thumbs.length) + thumbs.length) % thumbs.length;
        const activeThumb = thumbs[currentIndex];

        gambarUtama.src = activeThumb.dataset.src;

        thumbs.forEach((thumb, i) => {
            const isActive = i === currentIndex;
            thumb.classList.toggle('ring-2', isActive);
            thumb.classList.toggle('ring-blue-600', isActive);
            thumb.classList.toggle('opacity-100', isActive);
            thumb.classList.toggle('opacity-75', !isActive);
        });
    }

    function startSlide() {
        stopSlide();
        intervalId = setInterval(() => {
            setActiveSlide(currentIndex + 1);
        }, delayMs);
    }

    function stopSlide() {
        if (intervalId !== null) {
            clearInterval(intervalId);
            intervalId = null;
        }
    }

    thumbs.forEach((thumb, index) => {
        thumb.addEventListener('click', () => {
            setActiveSlide(index);
            startSlide();
        });
    });

    // Pause otomatis saat kursor diarahkan ke gambar utama atau area galeri
    gambarUtama.addEventListener('mouseenter', stopSlide);
    gambarUtama.addEventListener('mouseleave', startSlide);

    startSlide();
});
