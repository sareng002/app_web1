@if (session('success'))
    <div id="swal-success" data-message="{{ session('success') }}" hidden>
    </div>
@endif


@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}'
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Validasi Gagal',
            html: `{!! implode('<br>', $errors->all()) !!}`
        });
    </script>
@endif
