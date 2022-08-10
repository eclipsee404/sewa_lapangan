<?php 
$id_key = "klien";
$id_m = "klien_id";
$tablenm = "klien";
$id_key1 = $id_key . "_";
?>
<div class="row p-5">

    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Customer</li>
            </ol>
        </nav>
        <a href="" class="btn btn-secondary my-2 my-sm-0" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah
            Customer</a>
        <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" data-backdrop="static"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card">
                        <div class="card-body">
                            <form action="#" id="form">
                                <div class="form-group">
                                    <?php 
                                    $field = "nama";
                                    ?>
                                    <label for="<?= $id_key1."".$field ?>">Nama customer</label>
                                    <input type="text" name="<?= $id_key1."".$field ?>" class="form-control"
                                        id="<?= $id_key1."".$field ?>" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <?php 
                                    $field = "hp";
                                    ?>
                                    <label for="<?= $id_key1."".$field ?>">HP</label>
                                    <input type="number" name="<?= $id_key1."".$field ?>" class="form-control"
                                        id="<?= $id_key1."".$field ?>" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <?php 
                                    $field = "email";
                                    ?>
                                    <label for="<?= $id_key1."".$field ?>">Email</label>
                                    <input type="email" name="<?= $id_key1."".$field ?>" class="form-control"
                                        id="<?= $id_key1."".$field ?>" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <?php 
                                    $field = "pt";
                                    ?>
                                    <label for="<?= $id_key1."".$field ?>">Perusahaan</label>
                                    <input type="text" name="<?= $id_key1."".$field ?>" class="form-control"
                                        id="<?= $id_key1."".$field ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <?php 
                                    $field = "aktif";
                                    ?>
                                    <label for="<?= $id_key1."".$field ?>">Status</label>
                                    <select name="<?= $id_key1."".$field ?>" class="form-control"
                                        id="<?= $id_key1."".$field ?>">
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                                <input type="hidden" name="<?= $id_m; ?>" id="<?= $id_m; ?>">


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn" data-dismiss="modal">Close</button>
                        <button type="button" id="simpan" class="btn btn-secondary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>No</th>
                    <th>Nama customer</th>
                    <th>HP</th>
                    <th>Email</th>
                    <th>Perusahaan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php 
                        $no=1; 
                        $aktif[1] = "Aktif";
                        $aktif[0] = "Tidak Aktif";
                        foreach($customer as $data){
                            ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['klien_nama']; ?></td>
                        <td><?= $data['klien_hp']; ?></td>
                        <td><?= $data['klien_email']; ?></td>
                        <td><?= $data['klien_pt']; ?></td>
                        <td><?= $aktif[$data['klien_aktif']]; ?></td>
                        <td><a href="#" id="<?= $data['klien_id']; ?>" onclick="edit(<?= $data['klien_id']; ?>)"
                                class="btn btn-secondary btn-sm">Edit</a></td>
                    </tr>
                    <?php
                            $no++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
$("#simpan").click(function() {
    var data = $("#form").serialize();
    // alert($("#customer_nama").val());
    var fail = false;
    var fail_log = '';
    var name;
    //==========validasi field required=======================
    $('#form').find('select, textarea, input').each(function() {
        if (!$(this).prop('required')) {

        } else {
            if (!$(this).val()) {
                fail = true;
                name = $(this).attr('name');
                fail_log += name + " harus diisi \n";
            }

        }
    });
    //========================================================

    if (!fail) {
        //process form here.
        $.ajax({
            type: 'POST',
            url: "<?= base_url() ?>customer/simpan",
            data: data,
            success: function(data) {
                // alert(data);
                if (data == 1) {
                    // swal("Insert sukses!", "", "success");
                    swal({
                        title: "Sukses",
                        text: "Data Telah Disimpan",
                        button: "Tutup"
                    }).then(function() {
                        location.reload();
                    });
                    // setInterval(window.location.reload(), 5000);
                }

            }
        });
    } else {
        alert(fail_log);
    }

});

function edit(id) {
    // alert(id);
    $('#myModal').modal('show');
    $.getJSON('<?= base_url() ?>customer/get_edit/' + id, {

    }, function(json) {
        //alert('aaaa');

        if (json == false) {


        } else {
            $.each(json, function(index, val) {
                // console.log(val.customer_nama);
                $("#klien_nama").val(val.klien_nama);
                $("#klien_hp").val(parseInt(val.klien_hp));
                $("#klien_email").val(val.klien_email);
                $("#klien_pt").val(val.klien_pt);
                $("#klien_id").val(val.klien_id);
                $("#klien_aktif").val(val.klien_aktif);
            });

        }

        //alert(document.getElementById("harga_id").value);
        // alert(json.pesan_no);
    });
}
</script>