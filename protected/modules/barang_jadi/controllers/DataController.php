<?php

class DataController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('read', 'detail', 'cetak'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function getDataTransaksiBarang($id_barang, $tgl_awal, $tgl_akhir) {
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $q_tgl = "and tgl_transaksi between '{$tgl_awal}' and '{$tgl_akhir}'";
        } else {
            $q_tgl = '';
        }
        $query_transaksi = "
            select * from (
                (   select p.tgl_produksi tgl_transaksi,p.nomor_produksi no_bukti,p.jumlah_barang jumlah, 1 status_transaksi
                    from  produksi p 
                    where p.id_barang_jadi='{$id_barang}' and p.is_deleted='0' and p.is_saved='1' and p.id_peg_apv='1'
                )
                union
                (   select pb.tgl_penjualan tgl_transaksi,pb.nomor_penjualan no_bukti,pbd.jumlah_barang jumlah,2 status_transaksi
                    from penjualan pb
                    join penjualan_detail pbd on pb.id_penjualan=pbd.id_penjualan
                    where pbd.id_barang_jadi='{$id_barang}' and pbd.is_deleted='0' and pb.is_deleted='0'  and pb.is_saved='1'
                )
            ) a
            where a.tgl_transaksi is not null {$q_tgl}
            order by a.tgl_transaksi asc
            ";
        $data_transaksi = Yii::app()->db->createCommand($query_transaksi)->queryAll();
        return $data_transaksi;
    }

    /**
     * Declares class-based actions.
     */
    public function actionRead() {
        $query_barang = "
            select bj.id_barang_jadi,bj.kode_barang_jadi,bj.nama_barang_jadi,bj.deskripsi,s.nama_satuan,sum(pi.jumlah_barang) total_barang, pd.total_ambil
            from barang_jadi bj
            join produksi pi on pi.id_barang_jadi=bj.id_barang_jadi
            left join (
                select pd.id_barang_jadi,p.tgl_penjualan,sum(pd.jumlah_barang) total_ambil
                from penjualan_detail pd join penjualan p
                on pd.id_penjualan=p.id_penjualan
                where p.is_deleted='0' and pd.is_deleted='0'  and p.is_saved='1'
                group by pd.id_barang_jadi
            ) pd on pd.id_barang_jadi=bj.id_barang_jadi
            join satuan s on s.id_satuan = bj.id_satuan
            where (pi.jumlah_barang!='' or pd.total_ambil!='') AND pi.id_peg_apv='1'
			group by bj.nama_barang_jadi
            order by bj.nama_barang_jadi
            ";
        $data_barang = Yii::app()->db->createCommand($query_barang)->queryAll();
        $this->render('read', array(
            'data_barang' => $data_barang,
            'tgl_awal' => Yii::app()->request->getParam('tgl_awal'),
            'tgl_akhir' => Yii::app()->request->getParam('tgl_akhir'),
        ));
    }

    public function actionDetail() {
        $id_barang_jadi = Yii::app()->request->getParam('id');
        $tgl_awal = Yii::app()->request->getParam('tgl_awal');
        $tgl_akhir = Yii::app()->request->getParam('tgl_akhir');
        $data_transaksi = $this->getDataTransaksiBarang($id_barang_jadi, $tgl_awal, $tgl_akhir);

        $query_barang = "
            select b.*,s.nama_satuan 
            from barang_jadi b
            join satuan s on s.id_satuan =s.id_satuan
            where id_barang_jadi='{$id_barang_jadi}'
            ";
        $barang_jadi = Yii::app()->db->createCommand($query_barang)->queryRow();


        $this->render('detail', array(
            'barang_jadi' => $barang_jadi,
            'id_barang_jadi' => $id_barang_jadi,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'stok' => Yii::app()->request->getParam('s'),
            'data_transaksi' => $data_transaksi,
        ));
    }

    public function actionCetak() {
        $id_barang = Yii::app()->request->getParam('id');
        $tgl_awal = Yii::app()->request->getParam('tgl_awal');
        $tgl_akhir = Yii::app()->request->getParam('tgl_akhir');
        $data_transaksi = $this->getDataTransaksiBarang($id_barang, $tgl_awal, $tgl_akhir);
        $query_barang = "
            select b.*,s.nama_satuan 
            from barang b
            join satuan s on s.id_satuan =s.id_satuan
            where id_barang='{$id_barang}'
            ";
        $barang = Yii::app()->db->createCommand($query_barang)->queryRow();
        // PRINT PDF
        $mpdf = Yii::app()->ePdf->mpdf();

        $mpdf->SetHTMLHeader('<div style="text-align: center; width:100%">{PAGENO}</div>');
        # render (full page)
        $mpdf->WriteHTML($this->renderPartial('cetak', array(
                    'barang' => $barang,
                    'id_barang' => $id_barang,
                    'stok' => Yii::app()->request->getParam('s'),
                    'tgl_awal' => $tgl_awal,
                    'tgl_akhir' => $tgl_akhir,
                    'data_transaksi' => $data_transaksi,
                        )
                        , true)
        );
        $mpdf->Output();
    }

}
