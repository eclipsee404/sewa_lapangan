<?php 
$id_key = "sewa";
$id_m = "sewa_id";
$tablenm = "sewa";
$id_key1 = $id_key . "_";
if(isset($_REQUEST['tanggal']) == ""){
    $_REQUEST['tanggal'] = date("Y-m-d");
}
if(isset($_REQUEST['lapangan']) == ""){
    $_REQUEST['lapangan'] = "";
}
if(isset($_REQUEST['klien']) == ""){
    $_REQUEST['klien'] = "";
}

?>
<div class="row p-5">

    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Booking</li>
            </ol>
        </nav>
        <div class="row">

            <div class="col-md-2 " style="padding-top:25px !important;">
                <a href="<?= base_url() ?>booking/" class="btn btn-secondary my-2 my-sm-0">Kembali</a>
            </div>
        </div>
        <br>

        <br>
        <br>

        <div class="row">
            <div class="col-md-4">
                <?php 
                    $id = $this->uri->segment(3);
                    if($id > 0){
                        $this->db->select('*');
                        $this->db->from('sewa');
                        $this->db->where('sewa_id',$id);
                        $data = $this->db->get()->result_array();
                        foreach ($data as $value) {
                            if($_REQUEST['tanggal'] == ""){
                                $_REQUEST['tanggal'] = $value['sewa_tgl'];
                            }

                            if($_REQUEST['lapangan'] == ""){
                                $_REQUEST['lapangan'] = $value['lapangan_id'];
                            }
                            if($_REQUEST['klien'] == ""){
                                $_REQUEST['klien'] = $value['klien_id'];
                            }
                            
                        }
                        $dis = "disabled";
                    }else{
                        $dis = "";
                    }
                ?>
                <form action="" method="post">
                    <div class="form-group">
                        <?php 
                        $field = "";
                        ?>
                        <label for="tanggal">Tanggal</label>
                        <input type="text" name="tanggal" class="form-control datepicker" onchange="this.form.submit()"
                            id="tanggal" value="<?php echo $_REQUEST['tanggal']; ?>" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <?php 
                        $field = "";
                        ?>
                        <label for="<?= $id_key1."".$field ?>">Lapangan</label>
                        <select name="lapangan" id="lapangan" class="form-control select2" onchange="this.form.submit()"
                            required>
                            <option value=""></option>
                            <?php 
                            $this->db->select('*');
                            $this->db->from('lapangan');
                            $datas = $this->db->get()->result_array();
                        
                            foreach($datas as $row){
                                ?>
                            <option value="<?= $row['lapangan_id']; ?>"
                                <?php if($_REQUEST['lapangan'] == $row['lapangan_id']){echo "selected";} ?>>
                                <?= $row['lapangan_nama']; ?>
                            </option>
                            <?php
                                    }
                                
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <?php 
                        $field = "";
                        ?>
                        <label for="<?= $id_key1."".$field ?>">Pilih Customer</label>
                        <select name="klien" id="klien" class="form-control select2" onchange="this.form.submit()"
                            required <?= $dis; ?>>
                            <option value=""></option>
                            <?php 
                            unset($datas);
                            $this->db->select('*');
                            $this->db->from('klien');
                            $datas = $this->db->get()->result_array();
                        
                            foreach($datas as $row){
                                ?>
                            <option value="<?= $row['klien_id']; ?>"
                                <?php if($_REQUEST['klien'] == $row['klien_id']){echo "selected";} ?>>
                                <?= "[".$row['klien_hp']."] ".$row['klien_nama']; ?>
                            </option>
                            <?php
                                    }
                                
                            ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-md-8">
                <form action="#" method="post" id="form" enctype="multipart/form-data">
                    <?php 
                    if($_REQUEST['lapangan'] > 0){
                        $this->db->select('*');
                        $this->db->from('lapangan');
                        $this->db->where('lapangan_id',$_REQUEST['lapangan']);
                        $this->db->order_by('lapangan_nama','ASC');
                        $lapangan = $this->db->get()->result_array();
                        // var_dump($lapangan);
                        ?>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Jam</th>
                                <th>Check</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($lapangan as $data){
                            for($i = date("H:i",strtotime($data['lapangan_jam_buka'])); $i< date("H:i",strtotime($data['lapangan_jam_tutup'])); $i = date("H:i",strtotime($i." + 1 hour"))){

                                $this->db->select('*');
                                $this->db->from('sewa_detail');
                                $this->db->join('sewa','sewa.sewa_id = sewa_detail.sewa_id');
                                $this->db->where('lapangan_id',$data['lapangan_id']);
                                $this->db->where('sewa_tgl',$_REQUEST['tanggal']);
                                $this->db->where('sewa_detail_jam',$i);
                                $this->db->where('sewa_detail_aktif',1);
                                $this->db->where('sewa_aktif',1);
                                $id = $this->uri->segment(3);
                                
                                $cek = $this->db->get()->result_array();
                                // var_dump($cek);
                                // echo "keke<br>";
                                // echo count($cek);
                                // echo $id."<br>";
                                // echo $cek['sewa_detail_id'];

                                if($id > 0){
                                    $this->db->select('*');
                                    $this->db->from('sewa_detail');
                                    $this->db->join('sewa','sewa.sewa_id = sewa_detail.sewa_id');
                                    $this->db->where('lapangan_id',$data['lapangan_id']);
                                    $this->db->where('sewa_tgl',$_REQUEST['tanggal']);
                                    $this->db->where('sewa_detail_jam',$i);
                                    $this->db->where('sewa.sewa_id',$id);
                                    $this->db->where('sewa_detail_aktif',1);
                                    $this->db->where('sewa_aktif',1);
                                    $cek_detail = $this->db->get()->result_array();
                                    // foreach($cek_detail as $cek_details){
                                    //     echo $cek_details['sewa_detail_id'];
                                    // }
                                    if(count($cek_detail) > 0){
                                        $disabled = "";
                                        $checked = "checked";
                                    }else{
                                        // $disabled = "disabled";
                                        if(count($cek) > 0){
                                            $disabled = "disabled";
                                            $checked = "";
                                        }else{
                                            $disabled = "";
                                            $checked = "";
                                        }
                                    }
                                }else{
                                    if(count($cek) > 0){
                                        $disabled = "disabled";
                                        $checked = "";
                                    }else{
                                        $disabled = "";;
                                        $checked = "";
                                    }
                                    
                                }
                                
                            ?>
                            <tr <?php if(count($cek) > 0){ echo "style = 'background-color:red;'";} ?>>
                                <td><?php echo $i." - ".date("H:i",strtotime($i."+1hour")); ?>
                                </td>
                                <td>
                                    <input type="checkbox" style="width:30px; height:30px;" name="jamnya[]"
                                        value="<?php echo $i; ?>" <?php echo $disabled; echo $checked; ?>>
                                </td>
                            </tr>
                            <?php if($i == $data['lapangan_jam_tutup']){ break; } } } ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="klien_id" value="<?= $_REQUEST['klien']; ?>" id="klien_id" required>
                    <input type="hidden" name="lapangan_id" value="<?= $_REQUEST['lapangan']; ?>">
                    <input type="hidden" name="sewa_tgl" value="<?= $_REQUEST['tanggal']; ?>">
                    <input type="hidden" name="sewa_id" value="<?= $this->uri->segment(3); ?>">
                    <input type="button" class="btn btn-secondary" value="Simpan" id="simpan" style="width:100%">
                    <?php
                    }
                ?>
                </form>
            </div>
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
            url: "<?= base_url() ?>booking/insert_booking",
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
                        window.location.replace("<?= base_url() ?>booking");
                    });
                    // setInterval(window.location.reload(), 5000);
                }

            }
        });
    } else {
        alert(fail_log);
    }
});
</script>