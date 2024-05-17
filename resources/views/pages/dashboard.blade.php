@php
    use App\Models\akun;
    $akun = akun::all();
@endphp
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
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>
                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-percentage"></i>
                        <span class="text">Total Barang</span>
                        <span class="number">{{ $countTotal }}</span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-truck-loading"></i>
                        <span class="text">Barang Tersedia</span>
                        <span class="number">{{ $dataTotal }}</span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-confused"></i>
                        <span class="text">Barang Habis</span>
                        <span class="number">{{ $habisTotal }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="dash-content">
            @if (session()->get('level') == 'owner')
                <div class="overview">
                    <div class="title">
                        <i class="uil uil-clipboard-alt"></i>
                        <span class="text">Daftar Akun</span>
                    </div>
                    <div class="cek">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Akun</th>
                                    <th scope="col">Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($akun as $row)
                                    <tr>
                                        <th> {{ $row->username }} </th>
                                        <th> {{ $row->level }} </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="overview">
                    <div class="title">
                        <i class="uil uil-clipboard-alt"></i>
                        <span class="text">Daftar Barang</span>
                    </div>
                    <div class="cek">
                        @yield('table')
                    </div>
                </div>
            @endif
        </div>
    </section>
</body>
@yield('footer')

</html>
