@include('layouts.app')
@yield('header')

<body>
    @yield('sidebar')
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here..." id="myInput" />
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-export"></i>
                    <span class="text">Barang Keluar</span>
                </div>
                @if (session('sukses'))
                    @yield('success')
                @endif
                @if (session('fail'))
                    @yield('fail')
                @endif
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="Keluar">
                                <form action="barangKeluar" method="get" id="form-ajax">
                                    <input class="form-control mb-3" type="text" name="Nomor"
                                        placeholder="Nomor Barang" aria-label="default input example">
                                    <input class="form-control mb-3" type="text" name="Jumlah"
                                        placeholder="Jumlah Stok" aria-label="default input example">
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                @yield('table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @yield('footer')
</body>

</html>
