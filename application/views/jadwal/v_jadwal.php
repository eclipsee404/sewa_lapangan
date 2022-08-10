<?php 
$id_key = "lapangan";
$id_m = "lapangan_id";
$tablenm = "lapangan";
$id_key1 = $id_key . "_";
if(isset($_REQUEST['tanggal']) == ""){
    $_REQUEST['tanggal'] = date("Y-m-d");
}
?>
<style>
th:first-child,
td:first-child {
    position: sticky;
    left: 0px;
    background-color: grey;
}
</style>
<div class="row p-5">

    <div class="col-md-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
            </ol>
        </nav>

        <br>
        <div class="row">
            <div class="col-md-2">
                <form action="#" id="form" method="post">
                    <div class="form-group">
                        <?php 
                        $field = "";
                        ?>
                        <label for="tanggal">Pilih Tanggal</label>
                        <input type="text" name="tanggal" class="form-control datepicker" onchange="this.form.submit()"
                            id="tanggal" value="<?php echo $_REQUEST['tanggal']; ?>" autocomplete="off" required>
                    </div>
                </form>
            </div>
        </div>
        <br>


        <?php 
            $no=1; 
            $aktif[1] = "Aktif";
            $aktif[0] = "Tidak Aktif";
            foreach($lapangan as $data){

                
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" style="font-size:10px;">
                <thead>
                    <th style="width: 15px;">Nama</th>
                    <?php 
                        for($i = date("H:i",strtotime($data['lapangan_jam_buka'])); $i< date("H:i",strtotime($data['lapangan_jam_tutup'])); $i = date("H:i",strtotime($i." + 1 hour"))){
                            ?>
                    <th><?=  $i." - ".date("H:i",strtotime($i."+1hour")); ?></th>
                    <?php
                        if($i == $data['lapangan_jam_tutup']){ break; } } 
                    ?>

                </thead>
                <tbody>
                    <th style="width: 15px;"><?= $data['lapangan_nama']; ?></th>
                    <?php 
                        for($i = date("H:i",strtotime($data['lapangan_jam_buka'])); $i< date("H:i",strtotime($data['lapangan_jam_tutup'])); $i = date("H:i",strtotime($i." + 1 hour"))){
                            $this->db->select('*');
                            $this->db->from('sewa_detail');
                            $this->db->join('sewa','sewa.sewa_id = sewa_detail.sewa_id');
                            $this->db->where('lapangan_id',$data['lapangan_id']);
                            $this->db->where('sewa_tgl',$_REQUEST['tanggal']);
                            $this->db->where('sewa_detail_jam',$i);
                            $this->db->where('sewa_detail_aktif',1);
                            $this->db->where('sewa_aktif',1);
                            
                            $cek = $this->db->get()->result_array();
                            // var_dump($cek);
                            // echo "keke<br>";
                            // echo count($cek);
                            // echo $id."<br>";
                            // echo $cek['sewa_detail_id'];
                            ?>
                    <td <?php if(count($cek) > 0){ echo "style = 'background-color:red;'";} ?>></td>
                    <?php
                        if($i == $data['lapangan_jam_tutup']){ break; } } 
                    ?>
                </tbody>
            </table>
        </div>
        <hr>
        <br>

        <?php
            $no++;
            }
        ?>
    </div>

</div>