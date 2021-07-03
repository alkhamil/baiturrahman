<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Infaq -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Infaq
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($infaq->saldo) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Zakat Mal -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Zakat Mal
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($zakat_mal->saldo) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Zakat Fitrah -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Total Zakat Fitrah
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($zakat_fitrah->saldo) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Zakat Fitrah -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Total Kas
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($kas->saldo) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Grafik -->
<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="m-0 p-0 align-middle">
                    <span class="align-middle">Grafik Pemasukan & Pengeluaran</span>
                </h6>
            </div>
            <div class="card-body">
                <canvas id="grafik" width="100%" height="45"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    // data
    showLoad();
    setTimeout(() => {
        hideLoad();
    }, 1000);
    // end data

    let bulan = [];
    let total_pemasukan = [];
    let total_pengeluaran = [];
    get_grafik();

    function get_grafik() {
        $.ajax({
            type: "get",
            async: false,
            url: "<?= $get_grafik ?>",
            dataType: "json",
            success: function(res) {
                $.each(res, function(index, dt) {
                    bulan.push(dt.bulan);
                    total_pemasukan.push(parseInt(dt.total_pemasukan));
                    total_pengeluaran.push(parseInt(dt.total_pengeluaran));
                });
            }
        });
    }

    var grafik = document.getElementById("grafik").getContext('2d');
    var grafik_area = new Chart(grafik, {
        type: 'line',
        data: {
            labels: bulan,
            datasets: [
                {
                    label: "Pemasukan",
                    data: total_pemasukan,
                    backgroundColor: [
                        'rgba(28, 189, 0, 0.3)',
                    ],
                    borderColor: [
                        'rgba(28, 189, 0, 1)',
                    ],
                    borderWidth: 1
                },
                {
                    label: "Pengeluaran",
                    data: total_pengeluaran,
                    backgroundColor: [
                        'rgba(180, 34, 20, 0.3)',
                    ],
                    borderColor: [
                        'rgba(180, 34, 20, 1)',
                    ],
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginZero: true
                    }
                }]
            }
        }
    });
</script>