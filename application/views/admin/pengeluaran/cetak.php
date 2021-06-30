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
                                <i>Filter Berdasarkan : <br></i>
                                <?= ($trans_type_name) ? 'Trans Type Name: '.$trans_type_name.'<br>' : ''?>
                                <?= ($start_date) ? 'Periode: '.$start_date. ' - ' .$end_date : ''?>
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
                <th>Tanggal</th>
                <th>Code</th>
                <th>Sumber</th>
                <th>Jumlah</th>
            </tr>
            <?php $grand_total=0; foreach ($data as $key => $item) { $grand_total+=$item['amount'] ?>
                <tr>
                    <td><?= $key+1 ?></td>
                    <td><?= date('d-M-Y', strtotime($item['created_date'])) ?></td>
                    <td><?= $item['code'] ?></td>
                    <td><?= $item['trans_type_name'] ?></td>
                    <td  align="right"><?= number_format($item['amount']) ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="4" align="right"><b>Grand Total</b></td>
                <td align="right"><b><?= number_format($grand_total) ?></b></td>
            </tr>
        </table>
    </div>
</body>
</html>