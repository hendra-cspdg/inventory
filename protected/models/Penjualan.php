<?php

/**
 * This is the model class for table "permintaan_barang".
 *
 * The followings are the available columns in table 'permintaan_barang':
 * @property integer $id_penjualan
 * @property string $kode_sistem
 * @property string $nomor_penjualan
 * @property string $waktu_sistem
 * @property string $tgl_penjualan
 * @property string $tgl_on_site
 * @property string $status_kirim
 * @property integer $id_peg_apv
 * @property string $
 * @property integer $
 * @property string $is_saved
 * @property string $is_deleted
 */
class Penjualan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'penjualan';
	}
	
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_sistem, waktu_sistem', 'required'),
			array('id_peg_apv', 'numerical', 'integerOnly'=>true),
			array('kode_sistem', 'length', 'max'=>10),
			array('nomor_penjualan', 'length', 'max'=>30),
			array('status_kirim, status_jual, is_saved, is_deleted', 'length', 'max'=>2),
			array('tgl_penjualan, tgl_on_site', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_penjualan, kode_sistem, nomor_penjualan, nama_pembeli, alamat, waktu_sistem, tgl_penjualan, tgl_on_site, status_kirim, status_jual, id_peg_apv, is_saved, is_deleted', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_penjualan' => 'Id Penjualan',
			'kode_sistem' => 'Kode Sistem',
			'nomor_permintaan' => 'Nomor Penjualan',
			'nama_pembeli' => 'Nama Pembeli',
			'alamat' => 'Alamat',
			'waktu_sistem' => 'Waktu Sistem',
			'tgl_penjualan' => 'Tgl Penjualan',
			'tgl_on_site' => 'Tgl On Site',
			'status_kirim' => 'Status Kirim',
                        'status_jual' => 'Status Jual',
			'id_peg_apv' => 'Id Peg Apv',
			'is_saved' => 'Is Saved',
			'is_deleted' => 'Is Deleted',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_penjualan',$this->id_penjualan);
		$criteria->compare('kode_sistem',$this->kode_sistem,true);
		$criteria->compare('nomor_penjualan',$this->nomor_penjualan,true);
		$criteria->compare('nama_pembeli',$this->nama_pembeli);
		$criteria->compare('alamat',$this->alamat);
		$criteria->compare('waktu_sistem',$this->waktu_sistem,true);
		$criteria->compare('tgl_penjualan',$this->tgl_penjualan,true);
		$criteria->compare('tgl_on_site',$this->tgl_on_site,true);
		$criteria->compare('status_kirim',$this->status_kirim,true);
                $criteria->compare('status_jual',$this->status_kirim,true);
		$criteria->compare('id_peg_apv',$this->id_peg_apv);
		$criteria->compare('is_saved',$this->is_saved,true);
		$criteria->compare('is_deleted',$this->is_deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Produksi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
