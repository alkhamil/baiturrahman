<style>
  .border-radius-custom {
    border-bottom-left-radius: .35rem !important;
    border-top-left-radius: .35rem !important;
  }
</style>
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
            <form action="<?= $simpan ?>" method="POST" id="form-tabungan">
              <div class="row">
                <input type="hidden" name="id">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="jamaah_group_id" class="label-required">Group</label>
                    <select name="jamaah_group_id" id="jamaah_group_id" class="form-control form-required" style="width: 100%" data-placeholder="Pilih Group" required>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="hewan_id" class="label-required">Hewan</label>
                    <div class="input-group mb-3">
                      <input type="hidden" name="hewan_id" id="hewan_id" class="form-control">
                      <input type="text" name="hewan_label" id="hewan_label" class="form-control border-radius-custom" placeholder="Pilih Hewan" required readonly>
                      <div class="input-group-append">
                        <button class="btn btn-primary btn-browse-hewan" type="button">
                          <i class="fa fa-ellipsis-h "></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="start_date" class="label-required">Tanggal Mulai</label>
                    <input type="text" name="start_date" id="start_date" class="form-control form-required" required disabled autocomplete="off">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="end_date" class="label-required">Tanggal Selesai</label>
                    <input type="text" name="end_date" id="end_date" class="form-control form-required" required disabled autocomplete="off">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="duration" class="label-required">Durasi ( Bulan )</label>
                    <input type="number" name="duration" id="duration" class="form-control" required readonly>
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
        <h6 class="m-0 font-weight-bold text-primary">Daftar <?= $title ?></h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-sm" id="data" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Code</th>
                <th>Group</th>
                <th>Hewan Qurban</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Durasi</th>
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

<!-- Modal -->
<div class="modal fade" id="modal-browse-hewan" tabindex="-1" role="dialog" aria-labelledby="modal-browse-hewan-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Data Hewan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped table-sm" id="data-browse-hewan" width="100%">
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
      <div class="modal-footer">
        <i class="text-danger">*pilih salah satu hewan qurban</i>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-jamaah" tabindex="-1" role="dialog" aria-labelledby="modal-jamaah-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Data Jamaah</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped table-sm" id="data-jamaah" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <i class="text-danger">*Data group jamaah</i>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-tabungan-detail" tabindex="-1" role="dialog" aria-labelledby="modal-tabungan-detail-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Data Tabungan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-2">
          <div class="col-md-6">
            <table>
              <tr>
                <td>Code</td>
                <td>:</td>
                <td id="detail-code"></td>
              </tr>
              <tr>
                <td>Hewan Qurban</td>
                <td>:</td>
                <td id="detail-hewan-qurban"></td>
              </tr>
            </table>
          </div>
          <div class="col-md-6 d-flex justify-content-end">
            <table>
              <tr>
                <td>Tanggal Mulai</td>
                <td>:</td>
                <td id="detail-tanggal-mulai"></td>
              </tr>
              <tr>
                <td>Tanggal Selesai</td>
                <td>:</td>
                <td id="detail-tanggal-selesai"></td>
              </tr>
            </table>
          </div>
          <div class="col-md-12">
            <hr>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-sm" id="data-tabungan-detail" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Biaya</th>
                <th>Status</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Bayar</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" target="_blank" id="btn-cetak-tabungan" class="btn btn-info">
            <i class="fa fa-print"></i> Cetak
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  showLoad();

  var start_date = moment().format('DD-MM-YYYY');
  var end_date = moment().format('DD-MM-YYYY');
  var s_date = moment().format('MM/DD/YYYY');
  var n_date = moment().format('MM/DD/YYYY');
  $("#start_date").daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minDate: new Date(),
    locale: {
      format: 'DD-MM-YYYY'
    }
  }).on('apply.daterangepicker', function(ev, picker) {
    start_date = picker.startDate.format('DD-MM-YYYY');
    s_date = picker.startDate.format('MM/DD/YYYY');
    $(this).val(start_date);
    monthDiff(new Date(s_date), new Date(n_date));
  });

  $("#end_date").daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minDate: new Date(),
    locale: {
      format: 'DD-MM-YYYY'
    }
  }).on('apply.daterangepicker', function(ev, picker) {
    end_date = picker.startDate.format('DD-MM-YYYY');
    n_date = picker.startDate.format('MM/DD/YYYY');
    $(this).val(end_date);
    monthDiff(new Date(s_date), new Date(n_date));
  });

  function monthDiff(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months -= d1.getMonth();
    months += d2.getMonth();
    if (months <= 0) {
      $('#duration').val(0);
      Swal.fire('Gagal!', 'Harus lebih dari 1 bulan', 'warning');
      $('#submit').prop('disabled', true).css('cursor', 'not-allowed');
    } else {
      $('#duration').val(months);
      $('#submit').prop('disabled', false).css('cursor', 'pointer');
    }
  }

  $("#jamaah_group_id").select2({
    ajax: {
      url: "<?php echo $select_jamaah_group ?>",
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
      $('#start_date').prop('disabled', false);
      $('#end_date').prop('disabled', false);
      hideLoad();
    }, 800);
  }).on("select2:unselect", function(e) {}).on("change", function() {
    $('#start_date').val('').prop('disabled', true);
    $('#end_date').val('').prop('disabled', true);
  });

  // edit Transaksi
  $(document).on("click.ev", ".btn-edit", function(e) {
    e.preventDefault();
    showLoad();
    let $this = $(this);
    let id = $this.attr("data-id");
    let dataTarget = $('#accordionExample .card-header button').attr('data-target');
    let form = $('#form-tabungan');
    $.ajax({
      url: "<?= $get ?>?id=" + id,
      method: 'get',
      dataType: 'json',
      success: function(data) {
        let dt = data.hewan;
        hideLoad();
        scrollUp('#form-tabungan');
        $('#submit').prop('disabled', false).css('cursor', 'pointer');

        if (!$(dataTarget).hasClass('show')) {
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

  // data browse hewan
  let data_browse_hewan = $('#data-browse-hewan').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "searchDelay": 500,

    "ajax": {
      "url": "<?= $data_hewan; ?>",
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
    "columns": [{
        "data": "no"
      },
      {
        "data": "hewan_jenis_name"
      },
      {
        "data": "hewan_golongan_name"
      },
      {
        "data": "weight"
      },
      {
        "data": "label"
      },
      {
        "data": "price",
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
          var label = row.hewan_jenis_name + ' / ' + row.hewan_golongan_name + ' / Rp ' + formatCurrency(row.price);
          return `<button type="button" data-id="` + row.id + `" data-label="` + label + `" class="btn btn-sm btn-success btn-select-hewan">
                        <i class="fa fa-fw fa-check"></i>
                    </button>`;
        }
      },
    ]
  });

  $(document).on('click', '.btn-browse-hewan', function(e) {
    e.preventDefault();
    $('#modal-browse-hewan').modal('show');
  });
  $('#modal-browse-hewan').on("shown.bs.modal", function(e) {
    data_browse_hewan.draw();
  });

  $(document).on('click', '.btn-select-hewan', function(e) {
    e.preventDefault();
    var $this = $(this);
    $this.html('<i class="fa fa-spin fa-spinner"></i>').prop('disabled', true);
    var hewan_id = $this.attr('data-id');
    var hewan_label = $this.attr('data-label');
    $('#hewan_id').val(hewan_id);
    $('#hewan_label').val(hewan_label);
    setTimeout(() => {
      $('#modal-browse-hewan').modal('hide');
      $this.html('<i class="fa fa-fw fa-check"></i>').prop('disabled', false);
    }, 1000);
  });
  // end data browse hewan


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
        "data": "jamaah_group_name",
        "render": function(data, type, row) {
          var link = `<a href="" class="btn-view-group" data-id="` + row.jamaah_group_id + `">` + data + `</a`;
          return link;
        }
      },
      {
        "data": "hewan_qurban"
      },
      {
        "data": "start_date"
      },
      {
        "data": "end_date"
      },
      {
        "data": "duration"
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
          var row_data = JSON.stringify(row);
          return `<button type="button" data-id="` + row.id + `" data-row='`+row_data+`' title="Bayar untuk nabung" class="btn btn-sm btn-success btn-bayar">
                        <i class="fa fa-fw fa-money-bill-alt"></i>
                    </button>`;
        }
      },
    ]
  });
  var tabungan_id = null;
  var row = {};
  $(document).on('click', '.btn-bayar', function(e) {
    e.preventDefault();
    tabungan_id = $(this).attr('data-id');
    row = JSON.parse($(this).attr('data-row'));
    $('#detail-code').text(row.code);
    $('#detail-hewan-qurban').text(row.hewan_qurban);
    $('#detail-tanggal-mulai').text(row.start_date);
    $('#detail-tanggal-selesai').text(row.end_date);
    $('#modal-tabungan-detail').modal('show');
    let link = "<?= $cetak ?>" + "?id=" + row.id;
    $('#btn-cetak-tabungan').attr('href', link);
  });
  $('#modal-tabungan-detail').on("shown.bs.modal", function(e) {
    data_tabungan_detail.draw();
  });

  let data_tabungan_detail = $('#data-tabungan-detail').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "searchDelay": 500,
    "ajax": {
      "url": "<?= $data_tabungan_detail; ?>",
      "type": "POST",
      "data": function(data) {
        data.tabungan_id = tabungan_id
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
        "data": "amount",
        "render": function(data, type, row) {
          return 'Rp. ' + formatCurrency(data);
        }
      },
      {
        "data": "is_paid",
        "render": function(data, type, row) {
          return data == 1 ? `<span class="badge badge-success">Lunas</span>` : `<span class="badge badge-danger">Belum Lunas</span>`;
        }
      },
      {
        "data": "due_date",
      },
      {
        "data": "pay_date",
      },
      {
        "data": "id",
      }
    ],
    "columnDefs": [{
        "targets": [0, 5],
        "orderable": true,
        "searchable": false,
        "className": "text-center",
        "fixedColumns": true,
      },
      {
        "targets": 5,
        "className": "text-center",
        "fixedColumns": true,
        "render": function(data, type, row) {
          var disabled = row.is_paid == 1 ? 'disabled' : '';
          return `<button type="button" data-id="` + row.id + `" title="Bayar" class="btn btn-sm btn-success btn-bayar-item" ` + disabled + `>
                        <i class="fa fa-fw fa-check"></i>
                    </button>`;
        }
      },
    ]
  });

  $(document).on('click', '.btn-bayar-item', function(e) {
    e.preventDefault();
    var $this = $(this);
    var id = $this.attr('data-id');
    $this.html('<i class="fa fa-spin fa-spinner"></i>').prop('disabled', true);
    setTimeout(() => {
      $.ajax({
        type: "post",
        url: "<?= $bayar ?>",
        data: {
          id: id
        },
        dataType: "json",
        success: function(res) {
          if (res.type == 'success') {
            Swal.fire('Berhasil!', res.msg, 'success');
            data_tabungan_detail.draw();
          } else {
            Swal.fire('Gagal!', res.msg, 'warning');
          }
        }
      });
      $this.html('<i class="fa fa-fw fa-check"></i>').prop('disabled', false);
    }, 1000);
  });

  // end data

  // data jamaah
  let data_jamaah = $('#data-jamaah').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "searchDelay": 500,

    "ajax": {
      "url": "<?= $data_jamaah; ?>",
      "type": "POST",
      "data": function(data) {
        data.jamaah_group_id = jamaah_group_id
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
        "data": "jamaah_name"
      }
    ],

    "columnDefs": [{
      "targets": [0, 1],
      "orderable": true,
      "searchable": false,
      "className": "text-left",
      "fixedColumns": true,
    }]
  });
  var jamaah_group_id = null;
  $(document).on('click', '.btn-view-group', function(e) {
    e.preventDefault();
    jamaah_group_id = $(this).attr('data-id');
    $('#modal-jamaah').modal('show');
  });
  $('#modal-jamaah').on("shown.bs.modal", function(e) {
    data_jamaah.draw();
  });
  // end data jamaah

  // reset
  function resetForm(formEl) {
    $(formEl).trigger("reset");
    $(formEl).find('[type=hidden]').val('');
    $(formEl).find('select').empty().trigger('change');
    $('#submit').prop('disabled', true).css('cursor', 'not-allowed');
  }

  $("#reset").click(function() {
    resetForm("#form-tabungan");
  })
  // reset
</script>