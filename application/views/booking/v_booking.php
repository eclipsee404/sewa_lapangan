<?php 
$id_key = "sewa";
$id_m = "sewa_id";
$tablenm = "sewa";
$id_key1 = $id_key . "_";
if(isset($_REQUEST['tanggal']) == ""){
    $_REQUEST['tanggal'] = date("Y-m-d");
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
            <div class="col-md-2">
                <form action="<?= base_url(); ?>booking/" id="form" method="post">
                    <div class="form-group">
                        <?php 
                        $field = "";
                        ?>
                        <label for="tanggal">Filter Tanggal</label>
                        <input type="text" name="tanggal" class="form-control datepicker" onchange="this.form.submit()"
                            id="tanggal" value="<?php echo $_REQUEST['tanggal']; ?>" autocomplete="off" required>
                    </div>
                </form>
            </div>
            <div class="col-md-2 " style="padding-top:25px !important;">
                <a href="<?= base_url() ?>booking/add" class="btn btn-secondary my-2 my-sm-0">Tambah
                    Booking</a>
            </div>
        </div>
        <br>


        <br>
        <br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>No</th>
                    <th>Nama Lapangan</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Nama Customer</th>
                    <th>HP</th>
                    <th>Email</th>
                    <th colspan="2">
                        <center>Aksi</center>
                    </th>
                </thead>
                <tbody>
                    <?php 
                        $no=1; 
                        $aktif[1] = "Aktif";
                        $aktif[0] = "Tidak Aktif";
                        $jam = "";
                        foreach($sewa as $data){
                            $this->db->select('*');
                            $this->db->from('sewa_detail');
                            $this->db->where('sewa_id',$data['sewa_id']);
                            $this->db->where('sewa_detail_aktif',1);
                            $detail = $this->db->get()->result_array();
                            ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $data['lapangan_nama']; ?></td>
                        <td><?= $data['sewa_tgl']; ?></td>
                        <td>
                            <?php 
                                foreach($detail as $data_detail){
                                    $jam .= ",".$data_detail['sewa_detail_jam'];
                                    
                                }
                                echo substr($jam,1)." (".count($detail)." Jam)";
                            ?>
                        </td>
                        <td><?= $data['klien_nama']; ?></td>
                        <td><?= $data['klien_hp']; ?></td>
                        <td><?= $data['klien_email']; ?></td>
                        <td>
                            <center>
                                <a href="<?= base_url() ?>booking/add/<?= $data['sewa_id']; ?>"
                                    class="btn btn-secondary btn-sm">Edit</a>
                            </center>
                        </td>
                        <td>
                            <center>
                                <a href="<?= base_url() ?>booking/del/<?= $data['sewa_id']; ?>"
                                    onclick="javascript:return confirm('Yakin akan hapus?')"
                                    class="btn btn-secondary btn-sm">Hapus</a>
                            </center>
                        </td>
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
</script>