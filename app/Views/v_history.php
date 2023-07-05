<?= $this->extend('components/layout') ?>
<?= $this->section('content') ?>
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
}
?>
    <section>
        <?php foreach($datas as $index=>$data): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Belanja (<?php echo $data['created_date']?>)</h5>
                    <h6 class="card-subtitle mb-3 ">Id : <?php echo $data['id']?></h6>
                    <h6 class="card-subtitle mb-3 ">Ongkir : <?php echo $data['ongkir']?></h6>
                    <h6 class="card-subtitle mb-2 ">Total Biaya : <?php echo $data['total_harga']?></h6>
                    <p class="card-text">Status : <?php echo ($data['status']==0?$data['status'].' (Belum Selesai)' :$data['status'].' (Selesai)')?></p>
                    <p class="card-text"></p>
                    <a href="#" class="btn btn-success collapsed"  data-bs-toggle="collapse" data-bs-target="#collapse<?=$index ?>" aria-expanded="true" aria-controls="collapseOne">Cek Detail</a>
                    <div id="collapse<?=$index ?>" class="collapse py-3" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Jumlah</th> 
                                    <th scope="col">Diskon</th> 
                                    <th scope="col">Sub Total</th> 
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($datasDetail as $idx=>$dataDetail): ?>
                                <?php  if($dataDetail['id_transaksi']==$data['id']) : ?>
                                <tr>
                                    <td scope="col" >
                                    <div style="max-width : 100px">
                                        <img src="<?php echo base_url()."public/img/".$dataDetail['foto']?>" alt="produk" class="d-block w-100 m-0">
                                        <h6 class="mb-0 mt-1">id : <?= $dataDetail['id_barang']?></h6>
                                        <h6><?= $dataDetail['nama']?></h6>
                                    </div>
                                    </td>
                                    <td scope="col"><?= $dataDetail['jumlah']?></td> 
                                    <td scope="col"><?= $dataDetail['diskon']?></td> 
                                    <td scope="col"><?= $dataDetail['subtotal_harga']?></td> 
                                </tr>
                                <?php endif ?>
                            <?php endforeach ?> 
                            </tbody>
                        </table>  
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>   
    </section>
<?= $this->endSection() ?>