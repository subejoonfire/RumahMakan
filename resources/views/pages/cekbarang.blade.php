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
            <a type="submit" id="printButton" class="btn btn-primary float-right">Print</a>

        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-clipboard-alt"></i>
                    <span class="text">Daftar Barang</span>
                </div>
                <div class="cek">
                    @yield('table')
                </div>
            </div>
        </div>
    </section>
    @yield('footer')
</body>

</html>
