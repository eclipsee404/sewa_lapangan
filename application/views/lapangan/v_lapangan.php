<?php 
$id_key = "lapangan";
$id_m = "lapangan_id";
$tablenm = "lapangan";
$id_key1 = $id_key . "_";
?>
<div class="row p-5">

    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lapangan</li>
            </ol>
        </nav>
        <a href="" class="btn btn-secondary my-2 my-sm-0" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah
            Lapangan</a>
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
                                    <label for="<?= $id_key1."".$field ?>">Nama Lapangan</label>
                                    <input type="text" name="<?= $id_key1."".$field ?>" class="form-control"
                                        id="<?= $id_key1."".$field ?>" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <?php 
                                    $field = "biaya_sewa";
                                    ?>
                                    <label for="<?= $id_key1."".$field ?>">Biaya Sewa</label>
                                    <input type="number" name="<?= $id_key1."".$field ?>" class="form-control"
                                        id="<?= $id_key1."".$field ?>" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <?php 
                                    $field = "jam_buka";
                                    ?>
                                    <label for="<?= $id_key1."".$field ?>">Jam Buka</label>
                                    <input type="text" name="<?= $id_key1."".$field ?>" class="form-control"
                                        id="<?= $id_key1."".$field ?>" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <?php 
                                    $field = "jam_tutup";
                                    ?>
                                    <label for="<?= $id_key1."".$field ?>">Jam Tutup</label>
                                    <input type="text" name="<?= $id_key1."".$field ?>" class="form-control"
                                        id="<?= $id_key1."".$field ?>" autocomplete="off" required>
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
                    <th>Nama Lapangan</th>
                    <th>Biaya Sewa</th>
                    <th>Jam Buka</th>
                    <th>Jam Tutup</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php 
                        $no=1; 
                        $aktif[1] = "Aktif";
                        $aktif[0] = "Tidak Aktif";
                        foreach($lapangan as $data){
                            ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['lapangan_nama']; ?></td>
                        <td><?= number_format($data['lapangan_biaya_sewa'],0,",","."); ?></td>
                        <td><?= $data['lapangan_jam_buka']; ?></td>
                        <td><?= $data['lapangan_jam_tutup']; ?></td>
                        <td><?= $aktif[$data['lapangan_aktif']]; ?></td>
                        <td><a href="#" id="<?= $data['lapangan_id']; ?>" onclick="edit(<?= $data['lapangan_id']; ?>)"
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
    // alert($("#lapangan_nama").val());
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
            url: "<?= base_url() ?>lapangan/simpan",
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
    $.getJSON('<?= base_url() ?>lapangan/get_edit/' + id, {

    }, function(json) {
        //alert('aaaa');

        if (json == false) {


        } else {
            $.each(json, function(index, val) {
                // console.log(val.lapangan_nama);
                $("#lapangan_nama").val(val.lapangan_nama);
                $("#lapangan_biaya_sewa").val(parseInt(val.lapangan_biaya_sewa));
                $("#lapangan_jam_buka").val(val.lapangan_jam_buka);
                $("#lapangan_jam_tutup").val(val.lapangan_jam_tutup);
                $("#lapangan_id").val(val.lapangan_id);
                $("#lapangan_aktif").val(val.lapangan_aktif);
            });

        }

        //alert(document.getElementById("harga_id").value);
        // alert(json.pesan_no);
    });
}
</script>