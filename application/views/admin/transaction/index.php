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
                        <form action="<?= $simpan ?>" method="POST" id="form-transaction">
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
                                        <label for="zakat_type_id" class="label-required">Tipe Zakat</label>
                                        <select name="zakat_type_id" id="zakat_type_id" class="form-control form-required" style="width: 100%" data-placeholder="Pilih Tipe Zakat" required disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jamaah_id" class="label-required">Jamaah</label>
                                        <select name="jamaah_id" id="jamaah_id" class="form-control form-required" style="width: 100%" data-placeholder="Pilih Jamaah" required disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" id="wrap-label">
                                    <div class="form-group">
                                        <label for="label">Qty</label>
                                        <input type="text" name="label" id="label" class="form-control" placeholder="1 Kg / 1 Gram / 1 Liter" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6" id="wrap-amount">
                                    <div class="form-group">
                                        <label for="amount" class="label-required">Jumlah Uang</label>
                                        <input type="number" name="amount" id="amount" class="form-control" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="desc">Keterangan</label>
                                        <textarea name="desc" id="desc" cols="10" rows="3" class="form-control" disabled></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary">
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
                                <th>Tipe Transaksi</th>
                                <th>Tipe Zakat</th>
                                <th>Jamaah</th>
                                <th>Qty</th>
                                <th>Jumlah</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" class="bg-primary text-white"><b>Total:</b></th>
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

    var wrap_label = $('#wrap-label');
    var wrap_amount = $('#wrap-amount');
    wrap_label.hide();

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
            $('#zakat_type_id').prop('disabled', false);
            $('#jamaah_id').prop('disabled', false);
            $('#amount').prop('disabled', false);
            $('#label').prop('disabled', false);
            $('#desc').prop('disabled', false);
            hideLoad();
        }, 800);
    }).on("select2:unselect", function(e) {
        trans_type_id = null;
    }).on("change", function() {
        $('#zakat_type_id').val('').trigger('change').prop('disabled', true);
        $('#jamaah_id').val('').trigger('change').prop('disabled', true);
        $('#amount').val('').prop('disabled', true);
        $('#label').val('').prop('disabled', true);
        $('#desc').val('').prop('disabled', true);
    });

    let zakat_type_id = null;
    let zakat_type_name = null;
    $("#zakat_type_id").select2({
        ajax: {
            url: "<?php echo $select_zakat_type ?>",
            delay: 100,
            dataType: 'json',
            data: function(params) {
                var query = {
                    q: params.term,
                    type: 'public',
                    trans_type_id: trans_type_id
                }
                return query;
            },
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
        zakat_type_id = data.id;
        zakat_type_name = data.text;
        if (zakat_type_name == 'Emas' || zakat_type_name == 'Perak' || zakat_type_name == 'Beras') {
            wrap_label.show();
            wrap_amount.removeClass('col-md-6').addClass('col-md-3');
        } else {
            wrap_label.hide();
            wrap_amount.removeClass('col-md-3').addClass('col-md-6');
        }
    }).on("select2:unselect", function(e) {
        zakat_type_id = null;
        zakat_type_name = null;
    });

    let jamaah_id = null;
    $("#jamaah_id").select2({
        ajax: {
            url: "<?php echo $select_jamaah ?>",
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
        jamaah_id = data.id;
    }).on("select2:unselect", function(e) {
        jamaah_id = null;
    });

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

    // edit Transaksi
    $(document).on("click.ev", ".btn-edit", function(e) {
        e.preventDefault();
        showLoad();
        let $this = $(this);
        let id = $this.attr("data-id");
        let dataTarget = $('#accordionExample .card-header button').attr('data-target');
        let form = $('#form-transaction');
        $.ajax({
            url: "<?= $get ?>?id=" + id,
            method: 'get',
            dataType: 'json',
            success: function(data) {
                let dt = data.transaction;
                hideLoad();
                scrollUp('#form-transaction');
                $('#submit').prop('disabled', false).css('cursor', 'pointer');

                if (!$(dataTarget).hasClass('show')) {
                    $('#accordionExample .card-header button').click()
                }
                form.find('[name=id]').val(dt.id);
                let opt_trans_type = new Option(dt.trans_type_name, dt.trans_type_id, true, true);
                form.find('[name=trans_type_id]').append(opt_trans_type).trigger('change');

                let opt_zakat_type = new Option(dt.zakat_type_name, dt.zakat_type_id, true, true);
                form.find('[name=zakat_type_id]').append(opt_zakat_type).trigger('change').prop('disabled', false);

                let opt_jamaah = new Option(dt.jamaah_name, dt.jamaah_id, true, true);
                form.find('[name=jamaah_id]').append(opt_jamaah).trigger('change').prop('disabled', false);;

                if (dt.zakat_type_name == 'Emas' || dt.zakat_type_name == 'Perak' || dt.zakat_type_name == 'Beras') {
                    wrap_label.show();
                    wrap_amount.removeClass('col-md-6').addClass('col-md-3');
                    form.find('[name=label]').val(dt.label);
                } else {
                    wrap_label.hide();
                    wrap_amount.removeClass('col-md-3').addClass('col-md-6');
                }

                form.find('[name=amount]').val(dt.amount).prop('disabled', false);
                form.find('[name=desc]').val(dt.desc).prop('disabled', false);
            }
        });
    });
    // end edit transksi

    // hapus transaksi
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
    // end hapus transaksi

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
                "data": "zakat_type"
            },
            {
                "data": "jamaah_name"
            },
            {
                "data": "label",
                "render": function(data, type, row) {
                    return data ? data : '-';
                }
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
                "targets": [0, 8],
                "orderable": true,
                "searchable": false,
                "className": "text-center",
                "fixedColumns": true,
            },
            {
                "targets": 8,
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
                .column(7)
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(7, {
                    page: 'current'
                })
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(7).footer()).html(
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
        wrap_label.hide();
        wrap_amount.removeClass('col-md-3').addClass('col-md-6');
    }

    $("#reset").click(function() {
        resetForm("#form-transaction");
    })
    // reset
</script>