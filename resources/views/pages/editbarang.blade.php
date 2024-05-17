@include('layouts.app')
@yield('header')
@php
    use App\Models\barang;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Session;
    $id = request()->input('id');
    $barang = barang::where('idbarang', '=', $id)->first();
    Session::put('idbarang', $id);
    Session::put('stok', $barang->stok);
@endphp

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
                    <span class="text">Edit Barang</span>
                </div>
                @if (session('sukses'))
                    @yield('success')
                @endif
                @if (session('fail'))
                    @yield('fail')
                @endif
                <div class="tambah">
                    <form action="editBarangAction" method="get">
                        {{-- <div>Nomor Barang:</div>
                        <input class="form-control mb-3" value="{{ $barang->idbarang }}" type="text" readonly
                            name="idbarang" placeholder="Nama Barang" aria-label="default input example"> --}}
                        <div>Nama Barang :</div>
                        <input class="form-control mb-3" value="{{ $barang->nmbarang }}" type="text" name="Nama"
                            placeholder="Nama Barang" aria-label="default input example">
                        {{-- <div>Jumlah:</div>
                        <input class="form-control mb-3" value="{{ $barang->stok }}" type="text" name="Jumlah"
                            placeholder="Jumlah Stok" aria-label="default input example"> --}}
                        <div>Harga:</div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input class="form-control" value="{{ $barang->harga }}" type="text" name="Harga"
                                placeholder="Harga" aria-label="Harga" onkeyup="formatHarga(this)">
                        </div>
                        <div>Kategori:</div>
                        <input class="form-control mb-3" value="{{ $barang->kategori }}" type="text" name="Kategori"
                            placeholder="Kategori" aria-label="default input example">
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @yield('footer')
</body>

</html>
