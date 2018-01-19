<?php

class Nilai_asetController extends Controller {

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
                'actions' => array('read', 'detail', 'cetak','getNilaiBarangAset'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function getNilaiBarangKeluar($data_transaksi, $jumlah, $pointer, $sisa) {
        $str_hitung = array();
        $nilai_keluar = 0;
        
        $k = $jumlah;
        for ($i = $pointer; $i < count($data_transaksi); $i++) {
            $m = $data_transaksi[$i]['jumlah'];
            $hm = $data_transaksi[$i]['harga'];
            if ($sisa > 0) {
                $m = $sisa;
            }
            if (($k - $m) <= 0) {
                $nilai_keluar += $k * $hm;
                $pointer = $i;
                $sisa = $m-$k;
                array_push($str_hitung, ' ' . $k . ' x' . number_format($hm) . ' ');
                break;
            } else {
                $nilai_keluar +=$m * $hm;
                $pointer = $i;
                $k-=$m;
                $sisa = 0;
                array_push($str_hitung, ' ' . $m . ' x' . number_format($hm) . ' ');
            }
        }
        //echo $pointer.' -'.$sisa.'<br/>';
        return array('nilai_keluar' => $nilai_keluar, 'pointer' => $pointer, 'sisa' => $sisa, 'str_hitung' => $str_hitung);
    }

    

    private function getTransaksiBarangMasuk($id_barang, $tgl_awal, $tgl_akhir) {
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $q_tgl = "and tgl_transaksi between '{$tgl_awal}' and '{$tgl_akhir}'";
        } else {
            $q_tgl = '';
        }
        $query_transaksi = "
            select * from (
                (   select tt.tgl_terima tgl_transaksi,tt.nomor_ttm no_bukti,ttd.jumlah_terima jumlah,ttd.harga_terima as harga,ttd.keterangan, 1 status_transaksi
                    from tanda_terima tt 
                    join tanda_terima_detail ttd on ttd.id_tanda_terima=tt.id_tanda_terima
                    where ttd.id_barang='{$id_barang}' and ttd.is_deleted='0' and tt.is_deleted='0'  and tt.is_saved='1'
                )
            ) a
            where a.tgl_transaksi is not null {$q_tgl}
            order by a.tgl_transaksi asc
            ";
        $data_transaksi = Yii::app()->db->createCommand($query_transaksi)->queryAll();
        return $data_transaksi;
    }
    
    private function getJumlahTransaksiBarangMasuk($id_barang, $tgl_awal, $tgl_akhir){
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $q_tgl = "and tgl_transaksi between '{$tgl_awal}' and '{$tgl_akhir}'";
        } else {
            $q_tgl = '';
        }
        $query_transaksi = "
            select count(*) from (
                (   select tt.tgl_terima tgl_transaksi,tt.nomor_ttm no_bukti,ttd.jumlah_terima jumlah,ttd.harga_terima as harga,ttd.keterangan, 1 status_transaksi
                    from tanda_terima tt 
                    join tanda_terima_detail ttd on ttd.id_tanda_terima=tt.id_tanda_terima
                    where ttd.id_barang='{$id_barang}' and ttd.is_deleted='0' and tt.is_deleted='0'  and tt.is_saved='1'
                )
            ) a
            where a.tgl_transaksi is not null {$q_tgl}
            ";
        return Yii::app()->db->createCommand($query_transaksi)->queryScalar();
    }

    private function getTransaksiBarangKeluar($id_barang, $tgl_awal, $tgl_akhir) {
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $q_tgl = "and tgl_transaksi between '{$tgl_awal}' and '{$tgl_akhir}'";
        } else {
            $q_tgl = '';
        }
        $query_transaksi = "
            select * from (
                
                (   select pb.tgl_pengambilan tgl_transaksi,pb.nomor_pengambilan no_bukti,pbd.jumlah_ambil jumlah,0 as harga,pbd.keterangan,2 status_transaksi
                    from pengambilan_barang pb
                    join pengambilan_barang_detail pbd  on pb.id_pengambilan_barang=pbd.id_pengambilan_barang
                    where pbd.id_barang='{$id_barang}' and pbd.is_deleted='0' and pb.is_deleted='0'  and pb.is_saved='1'
                )
            ) a
            where a.tgl_transaksi is not null {$q_tgl}
            order by a.tgl_transaksi asc
            ";
        $data_transaksi = Yii::app()->db->createCommand($query_transaksi)->queryAll();
        return $data_transaksi;
    }

    private function getTransaksiBarang($id_barang, $tgl_awal, $tgl_akhir) {
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $q_tgl = "and tgl_transaksi between '{$tgl_awal}' and '{$tgl_akhir}'";
        } else {
            $q_tgl = '';
        }
        $query_transaksi = "
            select * from (
                (   select tt.tgl_terima tgl_transaksi,tt.nomor_ttm no_bukti,ttd.jumlah_terima jumlah,ttd.harga_terima as harga,ttd.keterangan, 1 status_transaksi
                    from tanda_terima tt 
                    join tanda_terima_detail ttd on ttd.id_tanda_terima=tt.id_tanda_terima
                    where ttd.id_barang='{$id_barang}' and ttd.is_deleted='0' and tt.is_deleted='0'  and tt.is_saved='1'
                )
                union
                (   select pb.tgl_pengambilan tgl_transaksi,pb.nomor_pengambilan no_bukti,pbd.jumlah_ambil jumlah,0 as harga,pbd.keterangan,2 status_transaksi
                    from pengambilan_barang pb
                    join pengambilan_barang_detail pbd  on pb.id_pengambilan_barang=pbd.id_pengambilan_barang
                    where pbd.id_barang='{$id_barang}' and pbd.is_deleted='0' and pb.is_deleted='0'  and pb.is_saved='1'
                )
            ) a
            where a.tgl_transaksi is not null {$q_tgl}
            order by a.tgl_transaksi asc
            ";
        $data_transaksi = Yii::app()->db->createCommand($query_transaksi)->queryAll();
        $arr_transaksi = array();
        $nilai_saldo = 0;
        $barang_saldo = 0;
        $pointer = 0;
        $sisa = 0;
        foreach ($data_transaksi as $d) {
            if ($d['status_transaksi'] == 1) {
                $nilai_masuk = $d['jumlah'] * $d['harga'];
                array_push($arr_transaksi, array(
                    'status_transaksi' => $d['status_transaksi'],
                    'tgl_transaksi'=>$d['tgl_transaksi'],
                    'no_bukti' => $d['no_bukti'],
                    'keterangan' =>$d['keterangan'],
                    'barang_masuk' => $d['jumlah'],
                    'barang_keluar' => '-',
                    'harga_masuk' => $d['harga'],
                    'harga_keluar' => $d['harga'],
                    'nilai_masuk' => $nilai_masuk,
                    'nilai_keluar' => '-',
                    'nilai_saldo' => $nilai_saldo+=$nilai_masuk,
                    'barang_saldo' => $barang_saldo+=$d['jumlah'],
                ));
            } else if ($d['status_transaksi'] == 2) {
                $h_keluar = $this->getNilaiBarangKeluar($this->getTransaksiBarangMasuk($id_barang, $tgl_awal, $tgl_akhir), $d['jumlah'], $pointer, $sisa);
                $pointer = $h_keluar['pointer'];
                $sisa = $h_keluar['sisa'];
                array_push($arr_transaksi, array(
                    'status_transaksi' => $d['status_transaksi'],
                    'tgl_transaksi'=>$d['tgl_transaksi'],
                    'no_bukti' => $d['no_bukti'],
                    'keterangan' =>$d['keterangan'],
                    'barang_masuk' => '-',
                    'barang_keluar' => $d['jumlah'],
                    'harga_masuk' => '-',
                    'nilai_masuk' => '-',
                    'nilai_keluar' => $h_keluar['nilai_keluar'],
                    'nilai_saldo' => $nilai_saldo-=$h_keluar['nilai_keluar'],
                    'barang_saldo' => $barang_saldo-=$d['jumlah'],
                    'str_hitung'=>$h_keluar['str_hitung']
                ));
            }
           
        }
         //echo "<pre>".print_r($arr_transaksi)."</pre>";
        return $arr_transaksi;
    }
    
    public function actionGetNilaiBarangAset() {
        $id_barang = Yii::app()->request->getPost('id');
        $jumlah = Yii::app()->request->getPost('jumlah');
        $data_transaksi = $this->getTransaksiBarangMasuk($id_barang, '', '');
        $jumlah_data_transaksi=$this->getJumlahTransaksiBarangMasuk($id_barang, '', '');
        $nilai_aset = 0;
        $k = $jumlah;
        for ($i = $jumlah_data_transaksi - 1; $i >= 0; $i--) {
            $m = $data_transaksi[$i]['jumlah'];
            $hm = $data_transaksi[$i]['harga'];
            if (($k - $m) <= 0) {

                $nilai_aset+=($k * $hm);
                break;
            } else {
                $nilai_aset+=($m * $hm);
                $k-=$m;
            }
        }
        echo number_format($nilai_aset);
    }

    /**
     * Declares class-based actions.
     */
    public function actionRead() {
        $arr_barang = array();
        $query_barang = "
            select b.id_barang,b.kode_barang,b.nama_barang,b.deskripsi,s.nama_satuan, ttd.total_terima, pbd.total_ambil,(ttd.total_terima-pbd.total_ambil) sisa
            from barang b
            left join (
                select ttd.id_barang,tt.tgl_terima,sum(ttd.jumlah_terima) total_terima
                from tanda_terima_detail ttd
                join tanda_terima tt on tt.id_tanda_terima=ttd.id_tanda_terima
                where tt.is_deleted='0' and ttd.is_deleted='0'  and tt.is_saved='1'
                group by ttd.id_barang
            ) ttd on ttd.id_barang=b.id_barang
            left join (
                select pbd.id_barang,pb.tgl_pengambilan,sum(pbd.jumlah_ambil) total_ambil
                from pengambilan_barang_detail pbd
                join pengambilan_barang pb on pbd.id_pengambilan_barang=pb.id_pengambilan_barang
                where pb.is_deleted='0' and pbd.is_deleted='0'  and pb.is_saved='1'
                group by pbd.id_barang
            ) pbd on pbd.id_barang=b.id_barang
            join satuan s on s.id_satuan = b.id_satuan
            where (ttd.total_terima!='' or pbd.total_ambil!='')
            order by b.nama_barang
            
            ";
        $data_barang = Yii::app()->db->createCommand($query_barang)->queryAll();
        $this->render('read', array(
            'data_barang' => $data_barang,
            'tgl_awal' => Yii::app()->request->getParam('tgl_awal'),
            'tgl_akhir' => Yii::app()->request->getParam('tgl_akhir'),
        ));
    }

    public function actionDetail() {
        $id_barang = Yii::app()->request->getParam('id');
        $tgl_awal = Yii::app()->request->getParam('tgl_awal');
        $tgl_akhir = Yii::app()->request->getParam('tgl_akhir');
        $data_transaksi = $this->getTransaksiBarang($id_barang, $tgl_awal, $tgl_akhir);

        $query_barang = "
            select b.*,s.nama_satuan 
            from barang b
            join satuan s on s.id_satuan =s.id_satuan
            where id_barang='{$id_barang}'
            ";
        $barang = Yii::app()->db->createCommand($query_barang)->queryRow();


        $this->render('detail', array(
            'barang' => $barang,
            'id_barang' => $id_barang,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'data_transaksi' => $data_transaksi,
        ));
    }

    public function actionCetak() {
        $id_barang = Yii::app()->request->getParam('id');
        $tgl_awal = Yii::app()->request->getParam('tgl_awal');
        $tgl_akhir = Yii::app()->request->getParam('tgl_akhir');
        $data_transaksi = $this->getTransaksiBarang($id_barang, $tgl_awal, $tgl_akhir);
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
