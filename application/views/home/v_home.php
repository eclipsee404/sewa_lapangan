<div class="row p-5">

    <div class="col-md-12">
        <div class="jumbotron">
            <h1 class="display-4">Tayo Futsal</h1>
            <p class="lead">Selamat datang di sistem reservasi lapangan futsal.</p>
            <hr class="my-4">
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="<?= base_url() ?>booking" role="button">Input Transaksi</a>
            </p>
        </div>

    </div>

    <div class="col-md-4">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <?php 
                        $this->db->select('*');
                        $this->db->from('klien');
                        $klien = $this->db->get()->result_array();

                    ?>
                    <th>Total Customer</th>
                    <th><?= count($klien); ?></th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="col-md-8"></div>

    <div class="col-md-4">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Lapangan</th>
                    <th style="text-align:right">Pendapatan Tanggal <?= date("Y-m-d"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $this->db->select('*');
                    $this->db->from('lapangan');
                    $lapangan = $this->db->get()->result_array();
                    $total = 0;
                    foreach($lapangan as $data){
                        $sql = "select count(*) as tot from sewa_detail as a left join sewa as b on a.sewa_id = b.sewa_id where b.sewa_tgl = '".date("Y-m-d")."' and b.lapangan_id = '".$data['lapangan_id']."' and a.sewa_detail_aktif = '1' and b.sewa_aktif = '1'";
                        
                        $this->db->from('sewa_detail');
                        $this->db->join('sewa','sewa_detail.sewa_id = sewa.sewa_id');
                        $this->db->where('sewa_tgl',date("Y-m-d"));
                        $this->db->where('lapangan_id',$data['lapangan_id']);
                        $this->db->where('sewa_detail_aktif',1);
                        $this->db->where('sewa_aktif',1);
                        $query = $this->db->get()->result_array();
                        $jumlah = count($query);
                        $pendapatan = $data['lapangan_biaya_sewa']*$jumlah;
                ?>
                <tr>
                    <td><?= $data['lapangan_nama']; ?></td>
                    <td style="text-align:right"><?= number_format($pendapatan,0,",","."); ?></td>
                </tr>
                <?php $total = $total+$pendapatan; } ?>
                <tr>
                    <th>Total Pendapatan</th>
                    <th style="text-align:right; color:red;"><?= number_format($total,0,",","."); ?></th>
                </tr>
            </tbody>
        </table>
    </div>

</div>