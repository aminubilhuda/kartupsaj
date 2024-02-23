<?php
$koneksi = mysqli_connect("localhost", "root", "");
mysqli_select_db($koneksi, "kartu");

$guru = mysqli_query($koneksi, "select * from guru");

$perpage = 16;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu UAS Guru</title>
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
        width: 30px;
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

    td {
        padding: 5px 5px;
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
    <?php while ($data = mysqli_fetch_array($guru)): ?>
    <?php
                    if (($data['id'] % 2 == 1) AND ($data['id'] % $perpage != 1))
                        echo "<tr>";
                    
                    if ($data['id'] % $perpage == 1)
                        echo '<div class="page"><table width="100%"><tr>';
                    ?>
    <td style="padding:5px;">
        <table class="kartu" style="width:10.4cm; border: 1px solid #000;">
            <tr>
                <td colspan="3" style="border-bottom: 1px solid #000;">
                    <table class="header">
                        <tr>
                            <td><img src="smkan.png" class="logo" /></td>
                            <td>
                                UJIAN AKHIR SEMESTER GENAP<br>
                                SMK ABDI NEGARA TUBAN<br>
                                TAHUN AJARAN 2019/2020
                            </td>
                            <td style="padding:5px;">
                                <div class="qrcode" id="qr_<?= $data['username'] ?>"
                                    data-value="<?= $data['username'] ?>" style="float: right"></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="data">
                <td width="115">Nama Guru</td>
                <td width="1">:</td>
                <td><?= $data['nama'] ?></td>
            </tr>
            <tr class="data">
                <td>Username</td>
                <td>:</td>
                <td><?= $data['username'] ?></td>
            </tr>
            <tr class="data">
                <td>Password</td>
                <td>:</td>
                <td><?= $data['password'] ?></td>
            </tr>
            <tr class="data">
                <td>Alamat URL</td>
                <td>:</td>
                <td>http://uas.smkabdinegara.sch.id/</td>
            </tr>
        </table>
    <td>
        <?php
                    if ($data['id'] % 2 == 0)
                        echo "</tr>";
                    
                    if ($data['id'] % $perpage == 0)
                        echo "</table></div>";
                    ?>
        <?php endwhile; ?>
</body>

</html>