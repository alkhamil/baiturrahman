<!-- Content Row -->
<div class="row content">
    <div class="load">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Form -->
    <div class="col-md-12">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-plus-circle"></i> <?= $title ?>
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <form action="<?= $simpan ?>" method="POST" id="form-pengeluaran">
                            <div class="row">
                                <input type="hidden" name="id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="trans_type_id" class="label-required">Tipe Transaksi</label>
                                        <select name="trans_type_id" id="trans_type_id" class="form-control form-required" style="width: 100%" data-placeholder="Pilih Tipe Transaksi" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total_saldo" class="label-required">Total Saldo</label>
                                        <input type="text" name="total_saldo" id="total_saldo" class="form-control" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="amount" class="label-required">Jumlah Pengeluaran</label>
                                        <input type="number" name="amount" id="amount" class="form-control" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="received_by" class="label-required">Penerima</label>
                                        <input type="text" name="received_by" id="received_by" class="form-control" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="desc" class="label-required">Keterangan</label>
                                        <textarea name="desc" id="desc" cols="10" rows="3" class="form-control" required disabled></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <button type="submit" id="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                    <button type="reset" id="reset" class="btn btn-danger">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end form -->

    <!-- listing -->
    <div class="col-md-12 mt-2">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Daftar <?= $title ?>
                    <button type="button" id="btn-cetak" class="btn btn-sm btn-info float-right">
                        <i class="fa fa-print"></i> Cetak
                    </button>
                </h6>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="accordion" id="accordionFilterTransaksi">
                            <div class="card">
                                <div class="card-header bg-info" id="headingFilter">
                                    <h6 class="mb-0">
                                        <button class="btn btn-success btn-circle btn-sm btn-change" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">
                                            <i class="fa fa-plus fa-fw"></i>
                                        </button>
                                        <strong class="ml-2 text-white">Filter Pencarian</strong>
                                    </h6>
                                </div>

                                <div id="collapseFilter" class="collapse show" aria-labelledby="headingFilter" data-parent="#accordionFilterTransaksi">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select name="filter_trans_type_id" id="filter_trans_type_id" class="form-control form-control-sm" style="width: 100%" data-placeholder="Filter Tipe Transaksi">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="duration" id="duration">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-info btn-block btn-filter">
                                                        Terapkan Filter
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="data" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Code</th>
                                <th>Sumber</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="bg-primary text-white"><b>Total:</b></th>
                                <th class="bg-primary text-white"></th>
                                <th class="bg-primary text-white"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end listing -->
</div>


<script>
    showLoad();

    var total_saldo = $('#total_saldo');

    let trans_type_id = null;
    let trans_type_name = null;
    $("#trans_type_id").select2({
        ajax: {
            url: "<?php echo $select_trans_type ?>",
            delay: 100,
            dataType: 'json',
            processResults: function(data) {
                let items = [];
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        let tempData = {
                            id: data[i].id,
                            text: data[i].name,
                            data: data[i]
                        }
                        items.push(tempData)
                    }
                }
                return {
                    results: items
                };
            }
        }
    }).on("select2:select", function(e) {
        let data = e.params.data;
        showLoad();
        setTimeout(() => {
            trans_type_id = data.id;
            trans_type_name = data.text;
            get_trans_saldo(trans_type_id);
            $('#amount').prop('disabled', false);
            $('#received_by').prop('disabled', false);
            $('#desc').prop('disabled', false);
            hideLoad();
        }, 800);
    }).on("select2:unselect", function(e) {
        trans_type_id = null;
    }).on("change", function() {
        $('#amount').val('').prop('disabled', true);
        $('#received_by').val('').prop('disabled', true);
        $('#desc').val('').prop('disabled', true);
    });

    function get_trans_saldo(trans_type_id) {
        var saldo = 0;
        $.ajax({
            type: "post",
            async: false,
            url: "<?= $get_trans_saldo ?>",
            data: {
                trans_type_id: trans_type_id
            },
            dataType: "json",
            success: function(res) {
                if (res) {
                    total_saldo.val(res);
                    saldo = res;
                    $('#submit').prop('disabled', false).css('cursor', 'pointer');
                } else {
                    total_saldo.val(0);
                    saldo = 0;
                    $('#amount').val('').prop('disabled', true);
                    $('#received_by').val('').prop('disabled', true);
                    $('#desc').val('').prop('disabled', true);
                    $('#submit').prop('disabled', true).css('cursor', 'not-allowed');
                }
            }
        });
        return saldo;
    }

    // FILTER
    let filter_trans_type_id = null;
    $("#filter_trans_type_id").select2({
        allowClear: true,
        ajax: {
            url: "<?php echo $select_trans_type ?>",
            delay: 100,
            dataType: 'json',
            processResults: function(data) {   
                let items = [];
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                    let tempData = {
                        id: data[i].id,
                        text: data[i].name,
                        data: data[i]
                    }
                    items.push(tempData)
                    }
                }
                return {
                    results: items
                };
                console.log(items);
            }
        }
    }).on("select2:select", function(e) {
        let data = e.params.data;
        filter_trans_type_id = data.id;
        loadData();
    }).on("select2:unselect", function(e){
        filter_trans_type_id = null; 
        loadData();  
    });

    let filter_start_date = moment().format('DD/MM/YYYY');
    let filter_end_date = moment().format('DD/MM/YYYY');
    $("#duration").daterangepicker({
      locale : {
          format : 'DD/MM/YYYY'
      }
    }).on('apply.daterangepicker', function (ev, picker) {
      filter_start_date = picker.startDate.format('DD/MM/YYYY');
      filter_end_date = picker.endDate.format('DD/MM/YYYY');
      loadData();
    }).on('cancel.daterangepicker', function(ev, picker) {
        filter_start_date = moment().format('DD/MM/YYYY');
        filter_end_date = moment().format('DD/MM/YYYY');
        loadData();
    });

    $(document).on("click.ev", ".btn-filter",  function() {
        loadData();
    });

    function loadData() { 
        showLoad();
        setTimeout(() => {
            table.ajax.reload();
            hideLoad();
        }, 800);
    }

    $(document).on("keyup.ev", "#amount", function(e) {
        let value = $(this).val();
        let saldo = total_saldo.val();
        if (parseFloat(saldo) <= 0) {
            $('#submit').prop('disabled', true).css('cursor', 'not-allowed');
        } else {
            if (parseFloat(value) > parseFloat(saldo)) {
                $('#submit').prop('disabled', true).css('cursor', 'not-allowed');
            } else {
                $('#submit').prop('disabled', false).css('cursor', 'pointer');
            }
        }
    });

    // cetak
    $(document).on("click.ev", "#btn-cetak",  function() {
        let query = "?";
        if (filter_trans_type_id) {
            query += "&filter_trans_type_id="+filter_trans_type_id;
        }
        if (filter_start_date) {
            query += "&filter_start_date="+filter_start_date;
        }
        if (filter_end_date) {
            query += "&filter_end_date="+filter_end_date;
        }
        showLoad();
        setTimeout(() => {
            Swal.fire({
                title: 'Cetak Semua Data ini?',
                text: "Anda akan di alihkan ke halaman baru untuk mencetak",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Cetak!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let link = "<?= $cetak ?>" + query;
                    window.open(link);
                    hideLoad();
                }else{
                    hideLoad();
                }
            });
        }, 1000);
    });

    // edit pengeluaran
    $(document).on("click.ev", ".btn-edit", function(e) {
        e.preventDefault();
        showLoad();
        let $this = $(this);
        let id = $this.attr("data-id");
        let dataTarget = $('#accordionExample .card-header button').attr('data-target');
        let form = $('#form-pengeluaran');
        $.ajax({
            url: "<?= $get ?>?id=" + id,
            method: 'get',
            dataType: 'json',
            success: function(data) {
                let dt = data.pengeluaran;
                hideLoad();
                scrollUp('#form-pengeluaran');
                $('#submit').prop('disabled', false).css('cursor', 'pointer');

                if (!$(dataTarget).hasClass('show')) {
                    $('#accordionExample .card-header button').click()
                }
                form.find('[name=id]').val(dt.id);
                let opt_trans_type = new Option(dt.trans_type_name, dt.trans_type_id, true, true);
                form.find('[name=trans_type_id]').append(opt_trans_type).trigger('change');

                let trans_saldo = get_trans_saldo(dt.trans_type_id);
                total_saldo.val(parseFloat(trans_saldo) + parseFloat(dt.amount));

                form.find('[name=amount]').val(dt.amount).prop('disabled', false);
                form.find('[name=received_by]').val(dt.received_by).prop('disabled', false);
                form.find('[name=desc]').val(dt.desc).prop('disabled', false);
            }
        });
    });
    // end edit pengeluaran

    // hapus pengeluaran
    $(document).on("click.ev", ".btn-hapus", function(e) {
        e.preventDefault();
        showLoad();
        let $this = $(this);
        let id = $this.attr("data-id");
        setTimeout(() => {
            Swal.fire({
                title: 'Anda yakin ingin hapus?',
                text: "Data ini akan hilang permanent",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= $hapus ?>?id=" + id,
                        method: 'get',
                        dataType: 'json',
                        success: function(data) {
                            if (data.type == 'success') {
                                Swal.fire('Terhapus!', data.msg, 'success')
                            } else {
                                Swal.fire('Gagal!', data.msg, 'warning')
                            }
                            hideLoad();
                            table.ajax.reload();
                        }
                    });
                } else {
                    hideLoad();
                }
            });
        }, 1000);
    });
    // end hapus pengeluaran


    // data
    let table = $("#data").DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "searchDelay": 500,

        "ajax": {
            "url": "<?= $data; ?>",
            "type": "POST",
            "data": function(data) {
                data.filter_trans_type_id = filter_trans_type_id;
                data.filter_start_date = filter_start_date;
                data.filter_end_date = filter_end_date;
            }
        },
        "fnInitComplete": function() {
            this.fnAdjustColumnSizing(true);
            hideLoad();
        },
        "autoWidth": true,
        "columns": [{
                "data": "no"
            },
            {
                "data": "created_date"
            },
            {
                "data": "code"
            },
            {
                "data": "trans_type"
            },
            {
                "data": "desc"
            },
            {
                "data": "amount",
                "render": function(data, type, row) {
                    return formatCurrency(data);
                }
            },
            {
                "data": "id"
            }
        ],

        "columnDefs": [{
                "targets": [0, 6],
                "orderable": true,
                "searchable": false,
                "className": "text-center",
                "fixedColumns": true,
            },
            {
                "targets": 6,
                "className": "text-center",
                "fixedColumns": true,
                "render": function(data, type, row) {
                    return `<button type="button" data-id="` + row.id + `" class="btn btn-sm btn-info btn-edit">
                        <i class="fa fa-fw fa-edit"></i>
                    </button>
                    <button type="button" data-id="` + row.id + `" class="btn btn-sm btn-danger btn-hapus">
                        <i class="fa fa-fw fa-trash"></i>
                    </button>`;
                }
            },
        ],
        "footerCallback": function(row, data, start, end, display) {
            var api = this.api(),
                data;

            // Remove the formatting to get integer data for summation
            var intVal = function(i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };

            // Total over all pages
            total = api
                .column(5)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(5, {
                    page: 'current'
                })
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(5).footer()).html(
                formatCurrency(pageTotal)
            );
        }
    });
    // end data

    // reset
    function resetForm(formEl) {
        $(formEl).trigger("reset");
        $(formEl).find('[type=hidden]').val('');
        $(formEl).find('select').empty().trigger('change');
        $('#submit').prop('disabled', true).css('cursor', 'not-allowed');
    }

    $("#reset").click(function() {
        resetForm("#form-pengeluaran");
    })
    // reset
</script>