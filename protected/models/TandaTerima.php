<?php

/**
 * This is the model class for table "tanda_terima".
 *
 * The followings are the available columns in table 'tanda_terima':
 * @property integer $id_tanda_terima
 * @property integer $id_supplier
 * @property string $kode_sistem
 * @property string $nomor_po
 * @property string $nomor_ttm
 * @property string $nomor_surat_jalan
 * @property string $waktu_sistem
 * @property string $tgl_terima
 * @property integer $id_peg_pj
 * @property string $nama_pengirim
 * @property string $nama_penerima
 * @property string $is_saved
 * @property string $is_deleted
 * @property string $is_po
 */
class TandaTerima extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tanda_terima';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_supplier, id_peg_pj', 'numerical', 'integerOnly'=>true),
			array('kode_sistem', 'length', 'max'=>10),
			array('nomor_po, nomor_ttm, nomor_surat_jalan', 'length', 'max'=>30),
			array('nama_pengirim, nama_penerima', 'length', 'max'=>20),
			array('is_saved, is_deleted, is_po', 'length', 'max'=>2),
			array('waktu_sistem, tgl_terima', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_tanda_terima, id_supplier, kode_sistem, nomor_po, nomor_ttm, nomor_surat_jalan, waktu_sistem, tgl_terima, id_peg_pj, nama_pengirim, nama_penerima, is_saved, is_deleted, is_po', 'safe', 'on'=>'search'),
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
			'id_tanda_terima' => 'Id Tanda Terima',
			'id_supplier' => 'Id Supplier',
			'kode_sistem' => 'Kode Sistem',
			'nomor_po' => 'Nomor Po',
			'nomor_ttm' => 'Nomor Ttm',
			'nomor_surat_jalan' => 'Nomor Surat Jalan',
			'waktu_sistem' => 'Waktu Sistem',
			'tgl_terima' => 'Tgl Terima',
			'id_peg_pj' => 'Id Peg Pj',
			'nama_pengirim' => 'Nama Pengirim',
			'nama_penerima' => 'Nama Penerima',
			'is_saved' => 'Is Saved',
			'is_deleted' => 'Is Deleted',
			'is_po' => 'Is Po',
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

		$criteria->compare('id_tanda_terima',$this->id_tanda_terima);
		$criteria->compare('id_supplier',$this->id_supplier);
		$criteria->compare('kode_sistem',$this->kode_sistem,true);
		$criteria->compare('nomor_po',$this->nomor_po,true);
		$criteria->compare('nomor_ttm',$this->nomor_ttm,true);
		$criteria->compare('nomor_surat_jalan',$this->nomor_surat_jalan,true);
		$criteria->compare('waktu_sistem',$this->waktu_sistem,true);
		$criteria->compare('tgl_terima',$this->tgl_terima,true);
		$criteria->compare('id_peg_pj',$this->id_peg_pj);
		$criteria->compare('nama_pengirim',$this->nama_pengirim,true);
		$criteria->compare('nama_penerima',$this->nama_penerima,true);
		$criteria->compare('is_saved',$this->is_saved,true);
		$criteria->compare('is_deleted',$this->is_deleted,true);
		$criteria->compare('is_po',$this->is_po,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TandaTerima the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
