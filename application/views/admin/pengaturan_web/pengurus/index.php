<!-- Content Row -->
<div class="row content">
    <div class="load">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Form -->
    <div class="col-md-12">
        <div class="accordion" id="accordionForm">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h6 class="m-0 p-0">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <i class="fa fa-plus"></i> <strong><?= $title ?></strong>
                        </button>
                    </h6>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionForm">
                    <div class="card-body">
                        <form action="<?= $simpan ?>" method="POST" id="form-pengurus" enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="" class="label-required">Picture</label> <span class="text-danger"><strong>Max 1000 x 500</strong></span>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input file-upload" id="picture" name="picture">
                                                <label class="custom-file-label" for="picture">Pilih file</label>
                                            </div>
                                        </div>
                                        <img class="profile-pic img-thumbnail" src="<?= base_url('assets/uploads/dft.png') ?>" style="width: 200px; height:300px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="label-required">Nama</label>
                                        <input type="text" class="form-control form-required" name="name" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="profession" class="label-required">Jabatan</label>
                                        <input type="text" class="form-control form-required" name="profession" id="profession" required>
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
        <!-- DataTales Form -->
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
                                <th>Picture</th>
                                <th>Name</th>
                                <th>Jabatan</th>
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

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.profile-pic').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-upload").on('change', function() {
        readURL(this);
    });

    // edit user
    $(document).on("click.ev", ".btn-edit", function(e) {
        e.preventDefault();
        showLoad();
        let $this = $(this);
        let id = $this.attr("data-id");
        let dataTarget = $('#accordionForm .card-header button').attr('data-target');
        let form = $('#form-pengurus');

        $.ajax({
            url: "<?= $get ?>?id=" + id,
            method: 'get',
            dataType: 'json',
            success: function(data) {
                let dt = data.pengurus;
                hideLoad();
                scrollUp('#form-pengurus');
                if (!$(dataTarget).hasClass('show')) {
                    $('#accordionForm .card-header button').click()
                }
                form.find('[name=id]').val(dt.id);
                form.find('[name=name]').val(dt.name);
                form.find('[name=profession]').val(dt.profession);
                if (dt.picture) {
                    form.find('.profile-pic').attr('src', dt.picture);
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
                "data": "picture",
                "render": function(data, type, row) {
                    return `<img src="` + data + `" alt="" class="img-thumbnail" width="100">`
                }
            },
            {
                "data": "name"
            },
            {
                "data": "profession"
            },
            {
                "data": "id"
            }
        ],

        "columnDefs": [{
                "targets": [0, 4],
                "orderable": true,
                "searchable": false,
                "className": "text-center",
                "fixedColumns": true,
            },
            {
                "targets": 4,
                "className": "text-center",
                "fixedColumns": true,
                "render": function(data, type, row) {
                    return `<button type="button" data-id="` + row.id + `" class="btn btn-sm btn-primary btn-edit">
                        <i class="fa fa-fw fa-edit"></i> Edit
                    </button>
                    <button type="button" data-id="` + row.id + `" class="btn btn-sm btn-danger btn-hapus">
                        <i class="fa fa-fw fa-trash"></i> Hapus
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
        $(formEl).find('select').val('').trigger('change');
    }

    $("#reset").click(function() {
        resetForm("#form-pengurus");
    })
    // reset
</script>