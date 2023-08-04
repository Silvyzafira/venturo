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
                                    <option value="">Pilih Tahun</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
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
                                    <td class="table-secondary" colspan="14"><b>Makanan</b></td>
                                </tr>
                                <tr>
                                    @foreach($menu as $item)
                                        @if($item->kategori=='makanan')
                                        <tr>
                                            <td>{{ $item->menu }}</td>
                                            <!-- @foreach($transaksi as $transaksiData)
                                                <td>{{$transaksiData->total}}</td>
                                            @endforeach -->
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
                                    <td class="table-secondary" colspan="14"><b>Minuman</b></td>
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
                                    <?php $totalTransaksiMenuBulan = 0; ?>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '01')
                                            <?php $totalTransaksiMenuBulan += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulan}}</td>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '02')
                                            <?php $totalTransaksiMenuBulan += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulan}}</td>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '03')
                                            <?php $totalTransaksiMenuBulan += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulan}}</td>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '04')
                                            <?php $totalTransaksiMenuBulan += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulan}}</td>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '05')
                                            <?php $totalTransaksiMenuBulan += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulan}}</td>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '06')
                                            <?php $totalTransaksiMenuBulan += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulan}}</td>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '07')
                                            <?php $totalTransaksiMenuBulan += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulan}}</td>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '08')
                                            <?php $totalTransaksiMenuBulan += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenu}}</td>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '09')
                                            <?php $totalTransaksiMenuBulan += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulan}}</td>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '10')
                                            <?php $totalTransaksiMenuBulan += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulan}}</td>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '11')
                                            <?php $totalTransaksiMenuBulan += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulan}}</td>
                                    @foreach($transaksi as $transaksiData)
                                        @if(date('m', strtotime($transaksiData->tanggal)) == '12')
                                            <?php $totalTransaksiMenuBulan += $transaksiData->total; ?>
                                        @endif
                                    @endforeach
                                    <td>{{$totalTransaksiMenuBulan}}</td>
                                    
                                    <?php $totalTransaksiMenuALL = 0; ?>
                                    <?php $totalTransaksiMenuALL += $totalTransaksiMenuBulan; ?>
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
