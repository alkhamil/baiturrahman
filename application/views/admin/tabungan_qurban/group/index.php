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
                        <form action="<?= $simpan ?>" method="POST" id="form-jamaah-group">
                            <div class="row">
                                <input type="hidden" name="id">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="label-required">Nama Group</label>
                                        <input type="text" class="form-control form-required" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="jamaah_id" class="label-required">Jamaah</label>
                                        <select name="jamaah_id[]" id="jamaah_id" class="form-control" multiple="multiple" style="width:100%" required>
                                        </select>
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
                <h6 class="m-0 font-weight-bold text-primary">Daftar <?= $title ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-sm" id="data" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jamaah</th>
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

    // edit user
    $(document).on("click.ev", ".btn-edit", function(e) {
        e.preventDefault();
        showLoad();
        let $this = $(this);
        let id = $this.attr("data-id");
        let dataTarget = $('#accordionExample .card-header button').attr('data-target');
        let form = $('#form-jamaah-group');

        $.ajax({
            url: "<?= $get ?>?id=" + id,
            method: 'get',
            dataType: 'json',
            success: function(data) {
                let dt = data.jamaah_group;
                hideLoad();
                scrollUp('#form-jamaah-group');
                if (!$(dataTarget).hasClass('show')) {
                    $('#accordionExample .card-header button').click()
                }
                form.find('[name=id]').val(dt.id);
                form.find('[name=name]').val(dt.name);

                form.find('#jamaah_id').val("").trigger('change');
                if (dt.jamaah) {
                    $.each(dt.jamaah, function(index, item) {
                        let opt_jamaah = new Option(item.jamaah_name, item.jamaah_id, true, true);
                        form.find('#jamaah_id').append(opt_jamaah).trigger('change');
                    });
                }
            }
        });
    });
    // end edit user

    // hapus user
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
    // end hapus user

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
    }).on("select2:unselect", function(e) {});

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
                "data": "name"
            },
            {
                "data": "jamaah",
                "render": function(data, type, row) {
                    var jamaah_names = data.map(function(item) {
                        return item['jamaah_name'];
                    });
                    return jamaah_names.toString();
                }
            },
            {
                "data": "id"
            }
        ],

        "columnDefs": [{
                "targets": [0, 3],
                "orderable": true,
                "searchable": false,
                "className": "text-center",
                "fixedColumns": true,
            },
            {
                "targets": 3,
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
    });
    // end data

    // reset
    function resetForm(formEl) {
        $(formEl).trigger("reset");
        $(formEl).find('[type=hidden]').val('');
    }

    $("#reset").click(function() {
        resetForm("#form-jamaah-group");
    })
    // reset
</script>