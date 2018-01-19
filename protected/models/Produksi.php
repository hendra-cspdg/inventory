<?php

/**
 * This is the model class for table "permintaan_barang".
 *
 * The followings are the available columns in table 'permintaan_barang':
 * @property integer $id_permintaan_barang
 * @property string $kode_sistem
 * @property string $nomor_permintaan
 * @property integer $id_proyek
 * @property string $waktu_sistem
 * @property string $tgl_permintaan
 * @property string $tgl_on_site
 * @property string $status_kirim
 * @property integer $id_peg_apv
 * @property string $status_diterima
 * @property integer $id_peg_peminta
 * @property string $is_saved
 * @property string $is_deleted
 */
class Produksi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'produksi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode_sistem, waktu_sistem', 'required'),
			array('id_barang_jadi', 'numerical', 'integerOnly'=>true),
			array('kode_sistem', 'length', 'max'=>10),
			array('nomor_produksi', 'length', 'max'=>30),
			array('status_produksi, is_saved, is_deleted', 'length', 'max'=>2),
			array('tgl_produksi', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_produksi, id_barang_jadi, kode_sistem, nomor_produksi, tgl_produksi, waktu_sistem, status_produksi, id_peg_apv, is_saved, is_deleted', 'safe', 'on'=>'search'),
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
			'id_produksi' => 'Id Produksi',
			'id_barang_jadi' => 'Id Barang Jadi',
			'kode_sistem' => 'Kode Sistem',
			'nomor_produksi' => 'Nomor Produksi',
			'tgl_produksi' => 'Tgl Produksi',
			'waktu_sistem' => 'Waktu Sistem',
			'status_produksi' => 'Status Produksi',
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

		$criteria->compare('id_produksi',$this->id_produksi);
		$criteria->compare('id_barang_jadi',$this->id_barang_jadi,true);
		$criteria->compare('kode_sistem',$this->kode_sistem,true);
		$criteria->compare('nomor_produksi',$this->nomor_produksi,true);
		$criteria->compare('waktu_sistem',$this->waktu_sistem,true);
		$criteria->compare('tgl_produksi',$this->tgl_permintaan,true);
		$criteria->compare('status_produksi',$this->status_produksi,true);
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
	 * @return PermintaanBarang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}