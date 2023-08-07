<!DOCTYPE html>
<?php
if(isset($_GET['tahun'])){
    $menu= json_decode(file_get_contents("http://tes-web.landa.id/intermediate/menu"));
    $transaksi= json_decode(file_get_contents("http://tes-web.landa.id/intermediate/transaksi?tahun=".$_GET['tahun']));
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TES - Venturo Camp Tahap 2</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            td,
            th {
                font-size: 11px;
            }
        </style>
    </head>
    <body>
    <div class="container-fluid">
        <div class="card" style="margin: 2rem 0rem;">
            <div class="card-header">
                Venturo - Laporan penjualan tahunan per menu
            </div>
            <div class="card-body">
                <form action="{{ route('fetch_data') }}" method="get">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <select id="my-select" class="form-control" name="tahun">
                                    @php
                                        $selectedYear = $tahun ?? null; // Menggunakan $tahun jika sudah ada, atau null jika belum ada
                                    @endphp
                                    @if($selectedYear == '2021')
                                        <option value="">Pilih Tahun</option>
                                        <option value="2021" selected>2021</option>
                                        <option value="2022">2022</option>>2022</option>
                                    @elseif($selectedYear == '2022')
                                        <option value="">Pilih Tahun</option>
                                        <option value="2021">2021</option>
                                        <option value="2022" selected>2022</option>
                                    @else
                                        <option value="" selected>Pilih Tahun</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">
                                Tampilkan
                            </button>
                            
                            @if(isset($transaksi))
                            <a href="http://tes-web.landa.id/intermediate/menu" target="_blank" rel="Array Menu" class="btn btn-secondary">
                                Json Menu
                            </a>
                            <a href="http://tes-web.landa.id/intermediate/transaksi?tahun={{{$tahun}}}" target="_blank" rel="Array Transaksi" class="btn btn-secondary">
                                Json Transaksi
                            </a>
                            <a href="" target="_blank" rel="Array Transaksi" class="btn btn-secondary">
                                Download Example
                            </a>
                            @endif
                        </div>
                    </div>
                </form>
                
                @if(isset($transaksi))
                <hr>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" style="margin: 0;">
                            <thead>
                                <tr class="table-dark">
                                    <th rowspan="2" style="text-align:center;vertical-align: middle;width: 250px;">Menu</th>
                                    <th colspan="12" style="text-align: center;">Periode Pada {{$tahun}}
                                    </th>
                                    <th rowspan="2" style="text-align:center;vertical-align: middle;width:75px">Total</th>
                                </tr>
                                <tr class="table-dark">
                                    <th style="text-align: center;width: 75px;">Jan</th>
                                    <th style="text-align: center;width: 75px;">Feb</th>
                                    <th style="text-align: center;width: 75px;">Mar</th>
                                    <th style="text-align: center;width: 75px;">Apr</th>
                                    <th style="text-align: center;width: 75px;">Mei</th>
                                    <th style="text-align: center;width: 75px;">Jun</th>
                                    <th style="text-align: center;width: 75px;">Jul</th>
                                    <th style="text-align: center;width: 75px;">Ags</th>
                                    <th style="text-align: center;width: 75px;">Sep</th>
                                    <th style="text-align: center;width: 75px;">Okt</th>
                                    <th style="text-align: center;width: 75px;">Nov</th>
                                    <th style="text-align: center;width: 75px;">Des</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="table-secondary"><b>Makanan</b></td>
                                    <?php  $totalTransaksiMakananJanuari = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '01') 
                                                        <?php $totalTransaksiMakananJanuari += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakananJanuari }}</b></td>
                                    <?php $totalTransaksiMakananFebruari = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '02') 
                                                        <?php $totalTransaksiMakananFebruari += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakananFebruari }}</b></td>
                                    <?php $totalTransaksiMakananMaret = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '03') 
                                                        <?php $totalTransaksiMakananMaret += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakananMaret }}</b></td>
                                    <?php $totalTransaksiMakananApril = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '04') 
                                                        <?php $totalTransaksiMakananApril += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakananApril }}</b></td>
                                    <?php $totalTransaksiMakananMei = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '05') 
                                                        <?php $totalTransaksiMakananMei += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakananMei }}</b></td>
                                    <?php $totalTransaksiMakananJuni = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '06') 
                                                        <?php $totalTransaksiMakananJuni += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakananJuni }}</b></td>
                                    <?php $totalTransaksiMakananJuli = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '07') 
                                                        <?php $totalTransaksiMakananJuli += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakananJuli }}</b></td>
                                    <?php $totalTransaksiMakananAgustus = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '08') 
                                                        <?php $totalTransaksiMakananAgustus += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakananAgustus }}</b></td>
                                    <?php $totalTransaksiMakananSeptember = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '09') 
                                                        <?php $totalTransaksiMakananSeptember += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakananSeptember }}</b></td>
                                    <?php $totalTransaksiMakananOktober = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '10') 
                                                        <?php $totalTransaksiMakananOktober += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakananOktober }}</b></td>
                                    <?php $totalTransaksiMakananNovember = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '11') 
                                                        <?php $totalTransaksiMakananNovember += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakananNovember }}</b></td>
                                    <?php $totalTransaksiMakananDesember= 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '12') 
                                                        <?php $totalTransaksiMakananDesember += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakananDesember }}</b></td>
                                    <?php $totalTransaksiTry = 0; $totalTransaksiMakanan = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @if(date('m', strtotime($transaksiData->tanggal)) == '01')
                                                <?php $totalTransaksiTry += $transaksiData->total; ?>
                                            @endif
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'makanan') 
                                                    @if ($item->menu == $transaksiData->menu) 
                                                        <?php $totalTransaksiMakanan += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMakanan }}</b></td>
                                </tr>
                                <tr>
                                    @foreach($menu as $item)
                                        @if($item->kategori=='makanan')
                                        <tr>
                                            <td>{{ $item->menu }}</td>
                                            <?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '01')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td>
                                            <?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '02')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td>
                                            <?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '03')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '04')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '05')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '06')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '07')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '08')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '09')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '10')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '11')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '12')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td>

                                            
                                            <?php $totalTransaksiMenuMENU = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu)
                                                    <?php $totalTransaksiMenuMENU += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{$totalTransaksiMenuMENU}}</td>
                                        </tr>
                                        @endif
                                    @endforeach

                                </tr>
                                <tr>
                                    <td class="table-secondary"><b>Minuman</b></td>
                                    <?php  $totalTransaksiMinumanJanuari = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '01') 
                                                        <?php $totalTransaksiMinumanJanuari += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinumanJanuari }}</b></td>
                                    <?php $totalTransaksiMinumanFebruari = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '02') 
                                                        <?php $totalTransaksiMinumanFebruari += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinumanFebruari }}</b></td>
                                    <?php $totalTransaksiMinumanMaret = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '03') 
                                                        <?php $totalTransaksiMinumanMaret += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinumanMaret }}</b></td>
                                    <?php $totalTransaksiMinumanApril = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '04') 
                                                        <?php $totalTransaksiMinumanApril += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinumanApril }}</b></td>
                                    <?php $totalTransaksiMinumanMei = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '05') 
                                                        <?php $totalTransaksiMinumanMei += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinumanMei }}</b></td>
                                    <?php $totalTransaksiMinumanJuni = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '06') 
                                                        <?php $totalTransaksiMinumanJuni += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinumanJuni }}</b></td>
                                    <?php $totalTransaksiMinumanJuli = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '07') 
                                                        <?php $totalTransaksiMinumanJuli += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinumanJuli }}</b></td>
                                    <?php $totalTransaksiMinumanAgustus = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '08') 
                                                        <?php $totalTransaksiMinumanAgustus += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinumanAgustus }}</b></td>
                                    <?php $totalTransaksiMinumanSeptember = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '09') 
                                                        <?php $totalTransaksiMinumanSeptember += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinumanSeptember }}</b></td>
                                    <?php $totalTransaksiMinumanOktober = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '10') 
                                                        <?php $totalTransaksiMinumanOktober += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinumanOktober }}</b></td>
                                    <?php $totalTransaksiMinumanNovember = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '11') 
                                                        <?php $totalTransaksiMinumanNovember += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinumanNovember }}</b></td>
                                    <?php $totalTransaksiMinumanDesember= 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu && date('m', strtotime($transaksiData->tanggal)) == '12') 
                                                        <?php $totalTransaksiMinumanDesember += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinumanDesember }}</b></td>
                                    <?php $totalTransaksiTry = 0; $totalTransaksiMinuman = 0;?>
                                    @foreach($transaksi as $transaksiData)
                                            @if(date('m', strtotime($transaksiData->tanggal)) == '01')
                                                <?php $totalTransaksiTry += $transaksiData->total; ?>
                                            @endif
                                            @foreach ($menu as $item)
                                                @if ($item->kategori == 'minuman') 
                                                    @if ($item->menu == $transaksiData->menu) 
                                                        <?php $totalTransaksiMinuman += $transaksiData->total;?>
                                                    @endif
                                                @endif
                                            @endforeach
                                    @endforeach
                                    <td class="table-secondary"><b>{{ $totalTransaksiMinuman }}</b></td>
                                </tr>
                                <tr>
                                    @foreach($menu as $item)
                                        @if($item->kategori=='minuman')
                                        <tr>
                                            <td>{{ $item->menu }}</td>
                                            <?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '01')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td>
                                            <?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '02')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td>
                                            <?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '03')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '04')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '05')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '06')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '07')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '08')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '09')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '10')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '11')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td><?php $totalTransaksiMenu = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu && date('m', strtotime($transaksiData->tanggal)) == '12')
                                                    <?php $totalTransaksiMenu += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{ $totalTransaksiMenu }}</td>
                                            
                                            <?php $totalTransaksiMenuMENU = 0; ?>
                                            @foreach($transaksi as $transaksiData)
                                                @if($transaksiData->menu == $item->menu)
                                                    <?php $totalTransaksiMenuMENU += $transaksiData->total; ?>
                                                @endif
                                            @endforeach
                                            <td>{{$totalTransaksiMenuMENU}}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tr>
                                <tr class="table-dark">
                                    <td><b>Total</b></td>
                                    <?php $totalTransaksiMenuBulanJanuari = 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '01')
                                            <?php $totalTransaksiMenuBulanJanuari += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulanJanuari}}</td>
                                    <?php $totalTransaksiMenuBulanFebruari= 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '02')
                                            <?php $totalTransaksiMenuBulanFebruari += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulanFebruari}}</td>
                                    <?php $totalTransaksiMenuBulanMaret= 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '03')
                                            <?php $totalTransaksiMenuBulanMaret += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulanMaret}}</td>
                                    <?php $totalTransaksiMenuBulanApril= 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '04')
                                            <?php $totalTransaksiMenuBulanApril += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulanApril}}</td>
                                    <?php $totalTransaksiMenuBulanMei= 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '05')
                                            <?php $totalTransaksiMenuBulanMei += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulanMei}}</td>
                                    <?php $totalTransaksiMenuBulanJuni= 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '06')
                                            <?php $totalTransaksiMenuBulanJuni += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulanJuni}}</td>
                                    <?php $totalTransaksiMenuBulanJuli= 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '07')
                                            <?php $totalTransaksiMenuBulanJuli += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulanJuli}}</td>
                                    <?php $totalTransaksiMenuBulanAgustus= 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '08')
                                            <?php $totalTransaksiMenuBulanAgustus += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulanAgustus}}</td>
                                    <?php $totalTransaksiMenuBulanSeptember= 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '09')
                                            <?php $totalTransaksiMenuBulanSeptember += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulanSeptember}}</td>
                                    <?php $totalTransaksiMenuBulanOktober= 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '10')
                                            <?php $totalTransaksiMenuBulanOktober += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulanOktober}}</td>
                                    <?php $totalTransaksiMenuBulanNovember= 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '11')
                                            <?php $totalTransaksiMenuBulanNovember += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulanNovember}}</td>
                                    <?php $totalTransaksiMenuBulanDesember= 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '12')
                                            <?php $totalTransaksiMenuBulanDesember += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulanDesember}}</td>
                                    
                                    <?php $totalTransaksiMenuALL = 0; ?>
                                    <?php $totalTransaksiMenuALL = $totalTransaksiMenuBulanJanuari+$totalTransaksiMenuBulanFebruari+$totalTransaksiMenuBulanMaret+$totalTransaksiMenuBulanApril+$totalTransaksiMenuBulanMei+$totalTransaksiMenuBulanJuni+$totalTransaksiMenuBulanJuli+$totalTransaksiMenuBulanAgustus+$totalTransaksiMenuBulanSeptember+$totalTransaksiMenuBulanOktober+$totalTransaksiMenuBulanNovember+$totalTransaksiMenuBulanDesember; ?>
                                    <td>{{$totalTransaksiMenuALL}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

            <!-- <?php if(isset($menu)){?>
                
            <div class="row m-3">
                <div class="col-6"><h4>Isi Json Menu</h4><pre style="height: 400px; background:#eaeaea;"><?php var_dump($menu) ?></pre></div>
                <div class="col-6"><h4>Isi Json Transaksi</h4><pre style="height: 400px; background:#eaeaea;"><?php var_dump($transaksi) ?></pre></div>
            </div>
            <?php }?> -->

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    </body>
</html>
