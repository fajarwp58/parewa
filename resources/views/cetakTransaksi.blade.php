<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-modern.min.css') }}">
  <style>
    @media print {
        #printPageButton {
            display: none;
        }
        @page {
        size: 180mm 207mm; /* landscape */
        /* you can also specify margins here: */
        margin: 25mm;
        margin-right: 45mm; /* for compatibility with both A4 and Letter */
  }
    }
    body {
        height: 842px;
        width: 595px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
    }
    u {
        padding-left:7em;
    }
    h5 {
        padding-left:2em;
    }
    h4 {
        padding-left:5em;
    }
    li {
        padding-left:10em;
    }
    p {
        padding-left:13em;
    }
    b {
        padding-block: 3em;
        padding-left:3em;
    }
    .box-dua{
	margin-left: 70px;
}
</style>


<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a id="printPageButton" href="{{ route('transaksi') }}">Back</a>
&nbsp;<button id="printPageButton" onClick="window.print();">Print</button><br>
</head>
<body>
    <tr>
        <td>
            <table>
                 <tr>
                     <td>
                        &nbsp;&nbsp;&nbsp;<span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-light.jpg') }}" alt="" height="75">
                        </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     </td>
                     <td align="left" style=" text-align: left">
                         <font size="4">
                             Parewa Coffee <br>
                         </font>
                         <font size="1">
                             Coffee And brew <br>
                             JL. Dr moh Hatta
                        </font>
                     </td>
                 </tr>
            </table>
        </td>
     </tr>
     ____________________________________________________________
    <br>
    <h3>No. {{$transaksi->id_penjualan}}</h3>

    <h3>
        <strong><u>NOTA PEMBAYARAN</u></strong>
    </h3>
    <br>
    <h5>Terima untuk pembayaran : Parewa <strong> Coffee</strong><br><br></h5>

    <h5>Pesanan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  : </h5>
    @foreach ($menu as $me)
    <h5><li>{{ $me->nama_menu }} :
        <div class="box-dua">
            <b> Rp  {{ format_uang($me->harga_jual) }},- </b></li></h5>
        </div>
    @endforeach

    <p>___________________________</p>

    <h4>Jumlah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b> Rp  {{ format_uang($transaksi->penjualan->total_bayar) }},- </b></h4>

    <br><br>
    <tr>
        <td>
            <font size="3">
                <table align="left" style="text-align: center;">
                    <tr>
                        <td width="350px"></td>
                        <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Padang, {{ $tgltransaksi }} <br><br>


                            <br><br>
                            <strong>{{ Auth::User()->username }}</strong>
                        </td>
                    </tr>
                </table>
            </font>
        </td>
    </tr>


</body>
</html>

<script>
    window.onload = function() { window.print(); }
</script>
