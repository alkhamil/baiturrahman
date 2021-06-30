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
                        <form action="<?= $simpan ?>" method="POST" id="form-about" enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="id" value="1">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="label-required">Nama Website</label>
                                        <input type="text" class="form-control form-required" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email" class="label-required">Email</label>
                                        <input type="email" class="form-control form-required" name="email" id="email" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone" class="label-required">Telepon</label>
                                        <input type="number" class="form-control form-required" name="phone" id="phone" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address" class="label-required">Alamat</label>
                                        <textarea name="address" id="address" class="form-control" cols="10" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="desc" class="label-required">Keterangan</label>
                                        <textarea name="desc" id="desc" class="form-control" cols="10" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="label-required">Logo Website</label> <span class="text-danger"><strong>Max 500 x 500</strong></span>
                                        <div class="input-group mb-3">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input file-upload" id="logo" name="logo">
                                                <label class="custom-file-label" for="logo">Pilih file</label>
                                            </div>
                                        </div>
                                        <img class="logo" src="<?= base_url('assets/uploads/dft.png') ?>" width="100" height="100">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="map" class="label-required">Maps</label>
                                        <input type="text" class="form-control form-required" name="map" id="map" required>
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
</div>


<script>
    showLoad();

    setTimeout(() => {
        hideLoad();
    }, 1000);

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-upload").on('change', function() {
        readURL(this);
    });

    let dataTarget = $('#accordionExample .card-header button').attr('data-target');
    let form = $('#form-about');

    $.ajax({
        url: "<?= $get ?>?id=" + 1,
        method: 'get',
        dataType: 'json',
        success: function(data) {
            let dt = data.about;
            hideLoad();
            scrollUp('#form-about');
            if (!$(dataTarget).hasClass('show')) {
                $('#accordionExample .card-header button').click()
            }
            form.find('[name=id]').val(dt.id);
            form.find('[name=name]').val(dt.name);
            form.find('[name=email]').val(dt.email);
            form.find('[name=phone]').val(dt.phone);
            form.find('[name=address]').val(dt.address);
            form.find('[name=desc]').val(dt.desc);
            form.find('[name=map]').val(dt.map);
            if (dt.logo) {
                form.find('.logo').attr('src', dt.logo);
            }
        }
    });

    // reset
    function resetForm(formEl) {
        $(formEl).trigger("reset");
        $(formEl).find('[type=hidden]').val('');
    }

    $("#reset").click(function() {
        resetForm("#form-about");
    })
    // reset
</script>