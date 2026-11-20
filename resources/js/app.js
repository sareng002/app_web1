
import Swal from 'sweetalert2';

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

        let html = '';

products.forEach(product => {

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

                <a
                    href="/products/${product.id}/edit"
                    class="bg-yellow-500 text-white px-2 py-1 rounded">

                    Edit

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
                        class="bg-red-500 text-white px-2 py-1 rounded">

                        Hapus

                    </button>

                </form>

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


// pemerosesan
document.addEventListener('DOMContentLoaded', function() {
    const galeri = document.getElementById('bannerGaleri');
    const gambarUtama = document.getElementById('gambarUtama');
    const thumbs = Array.from(document.querySelectorAll('.thumb-item'));

    if (!galeri || !gambarUtama || thumbs.length <= 1) return;

    let currentIndex = 0;
    let intervalId = null;
    const delayMs = 5000; // ganti gambar setiap 3 detik

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
