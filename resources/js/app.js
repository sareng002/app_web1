

const searchInput = document.getElementById('search');

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
                window.location.href = '/produk';
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
                    <td class="border p-2">${product.id}</td>
                    <td class="border p-2">${product.nama}</td>
                    <td class="border p-2">${product.harga}</td>
                    <td class="border p-2">${product.stok}</td>
                </tr>
            `;

        });

        document.getElementById('product-table')
            .innerHTML = html;



});


