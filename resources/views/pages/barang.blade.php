@include('layouts.app')

@yield('header')

<body>
    @yield('sidebar')
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" id="myInput" placeholder="Search here..." />
            </div>

        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-book-medical"></i>
                    <span class="text">Tambah Barang</span>
                </div>
                @if (session('sukses'))
                    @yield('success')
                @endif
                @if (session('fail'))
                    @yield('fail')
                @endif
                <div class="tambah">
                    <form action="tambahBarang" method="get">
                        <input class="form-control mb-3" type="text" name="Nama" placeholder="Nama Barang"
                            aria-label="default input example">
                        <input class="form-control mb-3" type="text" name="Jumlah" placeholder="Jumlah Stok"
                            aria-label="default input example">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input class="form-control" type="text" name="Harga" placeholder="Harga"
                                aria-label="Harga" onkeyup="formatHarga(this)">
                        </div>
                        <input class="form-control mb-3" type="text" name="Kategori" placeholder="Kategori"
                            aria-label="default input example">
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
                <div class="activity">
                    <div class="title">
                        <i class="uil uil-trash-alt"></i>
                        <span class="text">Edit/Hapus Barang</span>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nomor</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
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
                                    <th>
                                        <a href="editBarang?id={{ $row->idbarang }}" class="btn btn-success">Edit</a>
                                        <a href="hapusBarang?id={{ $row->idbarang }}" class="btn btn-danger">Hapus</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @yield('footer')
</body>

</html>
