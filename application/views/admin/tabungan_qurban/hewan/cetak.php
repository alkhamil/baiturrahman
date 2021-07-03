<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    
    <style>
    
    </style>
</head>

<body>
    <h2 style="text-align: center;"><?= $title ?></h2>
    <div class="invoice-boxs">
        <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
            <tr>
                <th>#</th>
                <th>Jenis Hewan</th>
                <th>Golongan</th>
                <th>Berat</th>
                <th>Label</th>
                <th>Harga</th>
            </tr>
            <?php foreach ($data as $key => $item) { ?>
                <tr style="text-align: center;">
                    <td><?= $key+1 ?></td>
                    <td><?= $item->hewan_jenis_name ?></td>
                    <td><?= $item->hewan_golongan_name ?></td>
                    <td><?= $item->weight ?></td>
                    <td><?= $item->label ?></td>
                    <td>Rp. <?= number_format($item->price) ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>