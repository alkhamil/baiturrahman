<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    
    <style>
    
    </style>
</head>

<?php 
    $about = $this->db->get_where('m_about', ['id'=>1])->row();
?>


<body>
    <h2 style="text-align: center;"><?= $title ?></h2>
    <div class="invoice-boxs">
        <table cellpadding="0" cellspacing="0" style="margin-bottom: 30px;">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?= $about->logo ?>" style="width:50">
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <td>Code</td>
                                        <td>:</td>
                                        <td><?= $data->code ?></td>
                                    </tr>
                                    <tr>
                                        <td>Hewan Qurban</td>
                                        <td>:</td>
                                        <td><?= $data->hewan_qurban ?></td>
                                    </tr>
                                    <tr>
                                        <td>Durasi</td>
                                        <td>:</td>
                                        <td><?= $data->duration ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jamaah</td>
                                        <td>:</td>
                                        <td><?= $data->jamaah ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <div class="invoice-boxs">
        <table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse: collapse;">
            <tr>
                <th>#</th>
                <th>Biaya</th>
                <th>Status</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Bayar</th>
            </tr>
            <?php $grand_total=0; foreach ($data->detail as $key => $item) { $grand_total+=$item['amount'] ?>
                <tr style="text-align: center;">
                    <td><?= $key+1 ?></td>
                    <td>Rp. <?= number_format($item['amount']) ?></td>
                    <td><?= $item['is_paid'] == 1 ? 'Lunas' : 'Belum Lunas' ?></td>
                    <td><?= date('d/m/Y', strtotime($item['due_date'])) ?></td>
                    <td><?= $item['pay_date'] !== null ? date('d/m/Y', strtotime($item['pay_date'])) : '' ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>