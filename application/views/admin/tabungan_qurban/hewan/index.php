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
                        <form action="<?= $simpan ?>" method="POST" id="form-hewan">
                            <div class="row">
                                <input type="hidden" name="id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hewan_jenis_id" class="label-required">Jenis Hewan</label>
                                        <select name="hewan_jenis_id" id="hewan_jenis_id" class="form-control form-required" style="width: 100%" data-placeholder="Pilih Jenis Hewan" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hewan_golongan_id" class="label-required">Golongan / Grade</label>
                                        <select name="hewan_golongan_id" id="hewan_golongan_id" class="form-control form-required" style="width: 100%" data-placeholder="Pilih Golongan / Grade" required disabled>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="weight" class="label-required">Berat</label>
                                        <input type="number" name="weight" id="weight" class="form-control" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="label" class="label-required">Label</label>
                                        <input type="text" name="label" id="label" class="form-control" placeholder="KG" required disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price" class="label-required">Harga</label>
                                        <input type="number" name="price" id="price" class="form-control" required disabled>
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
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="data" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Hewan</th>
                                <th>Golongan</th>
                                <th>Berat</th>
                                <th>Label</th>
                                <th>Harga</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end listing -->
</div>


<script>
    showLoad();
    
    let hewan_jenis_id = null;
    let hewan_jenis_name = null;
    $("#hewan_jenis_id").select2({
      ajax: {
        url: "<?php echo $select_hewan_jenis ?>",
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
        $('#hewan_golongan_id').prop('disabled', false);
        $('#weight').prop('disabled', false);
        $('#label').prop('disabled', false);
        $('#price').prop('disabled', false);
        hideLoad();
      }, 800);
    }).on("select2:unselect", function(e){
        trans_type_id = null;
    }).on("change", function () { 
        $('#hewan_golongan_id').val('').trigger('change').prop('disabled', true);
        $('#weight').val('').trigger('change').prop('disabled', true);
        $('#label').val('').prop('disabled', true);
        $('#price').val('').prop('disabled', true);
    });

    let hewan_golongan_id = null;
    let hewan_golongan_name = null;
    $("#hewan_golongan_id").select2({
        ajax: {
            url: "<?php echo $select_hewan_golongan ?>",
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
        zakat_type_id = data.id;
        zakat_type_name = data.text;
    }).on("select2:unselect", function(e){
        zakat_type_id = null;         
        zakat_type_name = null;
    });

    // edit Transaksi
    $(document).on("click.ev", ".btn-edit", function(e) {
        e.preventDefault();
        showLoad();
        let $this = $(this);
        let id = $this.attr("data-id");
        let dataTarget = $('#accordionExample .card-header button').attr('data-target');
        let form = $('#form-hewan');
        $.ajax({
            url: "<?= $get ?>?id=" + id,
            method: 'get',
            dataType: 'json',
            success: function(data){
                let dt = data.hewan;
                hideLoad();
                scrollUp('#form-hewan');
                $('#submit').prop('disabled', false).css('cursor', 'pointer');

                if(!$(dataTarget).hasClass('show')) {
                    $('#accordionExample .card-header button').click()
                }
                form.find('[name=id]').val(dt.id);
                let opt_hewan_jenis = new Option(dt.hewan_jenis_name, dt.hewan_jenis_id, true, true);
                form.find('[name=hewan_jenis_id]').append(opt_hewan_jenis).trigger('change');
                
                let opt_hewan_golongan = new Option(dt.hewan_golongan_name, dt.hewan_golongan_id, true, true);
                form.find('[name=hewan_golongan_id]').append(opt_hewan_golongan).trigger('change').prop('disabled', false);

                form.find('[name=weight]').val(dt.weight).prop('disabled', false);
                form.find('[name=label]').val(dt.label).prop('disabled', false);
                form.find('[name=price]').val(dt.price).prop('disabled', false);
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

    // cetak
    $(document).on("click.ev", "#btn-cetak",  function() {
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
                    let link = "<?= $cetak ?>";
                    window.open(link);
                    hideLoad();
                }else{
                    hideLoad();
                }
            });
        }, 1000);
    });
    // end cetak

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
            // 
        }
      },
      "fnInitComplete": function() {
        this.fnAdjustColumnSizing(true);
        hideLoad();
      },
      "autoWidth": true,
      "columns": [
        {
          "data": "no"
        },
        {
          "data": "hewan_jenis"
        },
        {
          "data": "hewan_golongan"
        },
        {
          "data": "weight"
        },
        {
          "data": "label"
        },
        {
          "data": "price",
          "render": function(data, type, row){
              return formatCurrency(data);
          }
        },
        {
          "data": "id"
        }
      ],
      
      "columnDefs": [
        {
          "targets": [0,6], 
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
      ]
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
      resetForm("#form-hewan");
    })
    // reset
</script>