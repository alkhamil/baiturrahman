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
                <th>Nama</th>
                <th>Telepon</th>
                <th>Alamat</th>
            </tr>
            <?php foreach ($data as $key => $item) { ?>
                <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['phone'] ?></td>
                    <td><?= $item['address'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>