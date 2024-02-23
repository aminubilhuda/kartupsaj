<?php
$koneksi = mysqli_connect("localhost", "root", "");
mysqli_select_db($koneksi, "kartu");

$siswa = mysqli_query($koneksi, "select * from siswa");
$perpage = 8;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Peserta PSAJ 2024</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box
    }

    body {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 11px;
        background: #E8E8E8;
    }

    .page {
        position: relative;
        width: 21.5cm;
        min-height: 33cm;
        page-break-after: always;
        margin: 0.5cm auto;
        background: #FFF;
        padding: 1.5cm;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        -webkit-box-sizing: initial;
        -moz-box-sizing: initial;
        box-sizing: initial;
    }

    .logo {
        width: 50px;
    }

    .foto {
        width: 2cm;
        height: 3cm;
    }

    table {
        border-collapse: collapse;
    }

    .header {
        width: 100%;
        text-align: center;
        font-weight: bold;
    }

    .footer {
        width: 100%;
        text-align: center;
    }

    .data>td {
        padding: 2px 5px;
        vertical-align: top;
    }

    .waktu {
        padding: 2px;
        text-align: center;
    }

    @media print {

        .page {
            height: 10cm;
            padding: 0.7cm;
            box-shadow: none;
            margin: 0
        }

        @page {
            size: 21.5cm 33cm;
            margin: 0;
            -webkit-print-color-adjust: exact;
        }
    }
    </style>

    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="qrcode.min.js"></script>
</head>

<body>
    <?php while ($data = mysqli_fetch_array($siswa)): ?>
    <?php
if (($data['id'] % 2 == 1) and ($data['id'] % $perpage != 1)) {
    echo "<tr>";
}

if ($data['id'] % $perpage == 1) {
    echo '<div class="page"><table width="100%"><tr>';
}

$no = $data['id'] % $perpage;
$posisi = mysqli_query($koneksi, "select * from posisi where no = ".$no);
list($no, $top, $left) = mysqli_fetch_array($posisi);

?>
    <td style="padding:5px;">
        <table class="kartu" style="width:10.4cm; border: 3px double #000;">
            <tr>
                <td colspan="3" style="border-bottom: 1px solid #000;">
                    <table class="header">
                        <tr>
                            <td><img src="smkan.png" class="logo" /></td>
                            <td>
                                KARTU PESERTA<br>
                                PENILAIAN SUMATIF AKHIR JENJANG<br>
                                SMK ABDI NEGARA TUBAN<br>
                                TAHUN AJARAN 2023/2024
                            </td>
                            <td style="padding:5px;">
                                <div class="qrcode" id="qr_<?=$data['username']?>" data-value="<?=$data['username']?>"
                                    style="float: right"></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="data">
                <td>Nomor Peserta</td>
                <td>:</td>
                <td><?=$data['no_peserta']?></td>
            </tr>
            <tr class="data">
                <td width="100">Nama Peserta</td>
                <td>:</td>
                <td><?=$data['nama']?></td>
            </tr>
            <tr class="data">
                <td>Kelas</td>
                <td>:</td>
                <td><?=$data['kelas']?></td>
            </tr>
            <tr class="data">
                <td>Username</td>
                <td>:</td>
                <td><?=$data['username']?></td>
            </tr>
            <tr class="data">
                <td>Password</td>
                <td>:</td>
                <td><?=$data['password']?></td>
            </tr>
            <tr class="data">
                <td>Ruang / Sesi</td>
                <td>:</td>
                <td><?=$data['ruang']." / ".$data['sesi']?></td>
            </tr>
            <!-- <tr class="data">
                <td>Alamat URL</td>
                <td>:</td>
                <td>http://uas.smkabdinegara.sch.id/</td>
            </tr> -->
            <tr class="data">
                <td rowspan="2" style="vertical-align:top;">Waktu<br><br>&nbsp;&nbsp;&nbsp;&nbsp;<img
                        src="foto/<?=$data['no_peserta']?>.JPG" class="foto" /></td>
                <td height="20" style="vertical-align:top;">:</td>
                <td>
                    <table border="1" width="90%">
                        <thead>
                            <tr>
                                <th class="waktu" width="40%">Jam ke-</th>
                                <th class="waktu">Waktu</th>
                            </tr>
                        </thead>
                        <tr>
                            <td class="waktu">I</td>
                            <td class="waktu">
                                <?php if ($data['sesi'] == 1): ?>
                                07.30 - 09.00
                                <?php elseif ($data['sesi'] == 2): ?>
                                11.00 - 12.30
                                <?php elseif ($data['sesi'] == 3): ?>
                                11.45 - 12.45
                                <?php endif;?>
                            </td>
                        </tr>
                        <tr>
                            <td class="waktu">II</td>
                            <td class="waktu">
                                <?php if ($data['sesi'] == 1): ?>
                                09.00 - 10.30
                                <?php elseif ($data['sesi'] == 2): ?>
                                12.30 - 14.00
                                <?php elseif ($data['sesi'] == 3): ?>
                                12.45 - 13.45
                                <?php endif;?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="data">
                <td style="vertical-align:top;">&nbsp;</td>
                <td>
                    <table class="footer">
                        <tr>
                            <td>Kepala SMK Abdi Negara Tuban</td>
                        </tr>
                        <tr>
                            <td align="left" height="50"><img src="ttd1.png"
                                    style="width:145px; position: absolute; top:<?=$top?>px; left:<?=$left?>px;">
                            </td>
                        </tr>
                        <tr>
                            <td>Nanang Slamet Mulyono, S.Pd</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <td>
        <?php
if ($data['id'] % 2 == 0) {
    echo "</tr>";
}

if ($data['id'] % $perpage == 0) {
    echo "</table></div>";
}

?>
        <?php endwhile;?>

        <script>
        // $('document').ready(function() {
        //     window.print();
        // });
        $('.qrcode').each(function() {
            new QRCode(document.getElementById($(this).attr('id')), {
                text: $(this).attr('data-value'),
                width: 50,
                height: 50,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        });
        </script>
</body>

</html>