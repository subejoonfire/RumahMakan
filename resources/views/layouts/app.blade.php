@section('table')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nomor</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Stok</th>
                <th scope="col">Harga</th>
                <th scope="col">Kategori</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @php
                use App\Models\barang;
                $barang = barang::all();
            @endphp
            @foreach ($barang as $row)
                @php
                    $harga = number_format($row->harga, 0, ',', '.') . ',00';
                @endphp
                <tr>
                    <th> {{ $row->idbarang }} </th>
                    <th> {{ $row->nmbarang }} </th>
                    <th> {{ $row->stok }} </th>
                    <th> Rp {{ $harga }} </th>
                    <th> {{ $row->kategori }} </th>
                    <th> {{ $row->status }} </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('header')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=0.5" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet" />
        <!----===== Iconscout CSS ===== -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
        <link rel="shortcut icon" type="image/x-icon" href="../../assets/profile.png" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <!-- Fontawsome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- jQuery -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="css/style_menu.css">

        <title>Pencatatan Barang</title>

        <style>
            body {
                font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
            }
        </style>

    </head>
@endsection
@section('sidebar')
    <nav class="sidebar">
        <div class="menu-items">
            <ul class="nav-links">
                <li>
                    <a href="dashboard">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dahsboard</span>
                    </a>
                </li>
                @if (session()->get('level') == 'owner')
                    <li>
                        <a href="cekbarang">
                            <i class="uil uil-clipboard-alt"></i>
                            <span class="link-name">Cek Barang</span>
                        </a>
                    </li>
                @endif
                @if (session()->get('level') == 'admin' || session()->get('level') == 'pegawai')
                    <li>
                        <a href="barangmasuk">
                            <i class="uil uil-import"></i>
                            <span class="link-name">Barang Masuk</span>
                        </a>
                    </li>

                    <li>
                        <a href="barangkeluar">
                            <i class="uil uil-export"></i>
                            <span class="link-name">Barang Keluar</span>
                        </a>
                    </li>

                    <li>
                        <a href="barang">
                            <i class="uil uil-edit"></i>
                            <span class="link-name">Edit Barang</span>
                        </a>
                    </li>
                @endif
                @if (session()->get('level') == 'admin' || session()->get('level') == 'owner')
                    <li>
                        <a href="riwayat">
                            <i class="fa fa-history"></i>
                            <span class="link-name">Riwayat</span>
                        </a>
                    </li>
                @endif
                <div class="logout-mode">
                    <li>
                        <a href="logout">
                            <i class="uil uil-signout"></i>
                            <span class="link-name">Logout</span>
                        </a>
                    </li>

                    <li class="mode">
                        <a href="#">
                            <i class="uil uil-moon"></i>
                            <span class="link-name">Dark Mode</span>
                        </a>

                        <div class="mode-toggle" id="switch">
                            <span class="switch"></span>
                        </div>
                    </li>
                </div>
        </div>
    </nav>
@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script_menu.js"></script>
    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        var table = $('#myTable').DataTable();
        $('#myInput').on('keyup', function() {
            table.search(this.value).draw();
        });
    </script>
    <script>
        function formatHarga(input) {
            let harga = input.value.replace(/\.|Rp\s/g, '');
            let reverseHarga = harga.split('').reverse().join('');
            let formattedHarga = reverseHarga.replace(/(\d{3})(?=\d)/g, '$1.').split('').reverse().join('');
            input.value = formattedHarga;
        }
        document.addEventListener('DOMContentLoaded', function() {
            let inputsHarga = document.querySelectorAll('input[name="Harga"]');
            inputsHarga.forEach(function(input) {
                formatHarga(input);
            });
        });
    </script>
    <script>
        $('#printButton').on('click', function() {
            $('.sidebar, .top, .button').hide();
            window.print();
            $('.sidebar, .top, .button').show();
        });
    </script>
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script> --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-success").click(function() {
                $(".table").show(50);
            });
            $(".btn-danger").click(function() {
                $(".table").hide(50);
            });
        });
    </script>
    {{-- AJAX --}}
    {{-- <script>
        $(document).ready(function() {
            $('#form-ajax').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var data = form.serialize();
                $.ajax({
                    type: method,
                    url: url,
                    data: data,
                    success: function(response) {

                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $.ajax({
                    type: "GET",
                    url: "layouts.table",
                    success: function(response) {
                        $('#table-ajax').html(response);
                    }
                });
            }, 400);
        });
    </script> --}}
@endsection
@section('success')
    <script>
        Swal.fire(
            'Berhasil',
            '',
            'success'
        )
    </script>
@endsection
@section('fail')
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('fail') }}',
        })
    </script>
@endsection
