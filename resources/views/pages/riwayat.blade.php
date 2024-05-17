@php
    use App\Models\riwayat;
    $riwayat = riwayat::all();
@endphp
@include('layouts.app')
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=0.3" />

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/style_menu.css">

    <title>Pencatatan Barang</title>

    <style>
        body {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>

</head>

<body>
    @yield('sidebar')
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" id="myInput" placeholder="Search here..." />
            </div>
            @if (session()->get('level') == 'owner')
                <a type="submit" id="printButton" class="btn btn-primary float-right">Print</a>
            @endif

        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Riwayat</span>
                </div>
                @if (session('sukses'))
                    @yield('success')
                @endif
                <!-- Button -->
                <form class="button" action="hapusRiwayat" method="get">
                    <button type="submit" class="btn btn-danger">Hapus Riwayat</button>
                </form>
                <!------------>
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">Nomor User</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nomor Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Aktivitas</th>
                            <th scope="col">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayat as $row)
                            @php
                                $harga = number_format($row->harga, 0, ',', '.') . ',00';
                            @endphp
                            <tr>
                                <th> {{ $row->idakun }} </th>
                                <th> {{ $row->username }} </th>
                                <th> {{ $row->idbarang }} </th>
                                <th> {{ $row->nmbarang }} </th>
                                <th> {{ $row->stok }} </th>
                                <th> Rp {{ $harga }} </th>
                                <th> {{ $row->kategori }} </th>
                                <th> {{ $row->catatan }} </th>
                                <th> {{ $row->waktu }} </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @yield('footer')
</body>

</html>
