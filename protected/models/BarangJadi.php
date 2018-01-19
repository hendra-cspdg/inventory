<?php

/**
 * This is the model class for table "barang".
 *
 * The followings are the available columns in table 'barang':
 * @property integer $id_barang
 * @property integer $id_satuan
 * @property string $kode_barang
 * @property string $nama_barang
 * @property string $merk
 * @property string $deskripsi
 * @property string $jenis_barang
 * @property string $is_deleted
 */
class BarangJadi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'barang_jadi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_barang_jadi, id_satuan, harga', 'numerical', 'integerOnly'=>true),
			array('kode_barang_jadi, harga', 'length', 'max'=>20),
			array('nama_barang_jadi', 'length', 'max'=>50),
			array('deskripsi', 'length', 'max'=>200),
			array('is_delected', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_barang_jadi, id_satuan, kode_barang_jadi, nama_barang_jadi, harga, deskripsi,  is_delected', 'safe', 'on'=>'search'),
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
			'id_barang_jadi' => 'Id Barang Jadi',
			'id_satuan' => 'Id Satuan',
			'kode_barang_jadi' => 'Kode Barang Jadi',
			'nama_barang_jadi' => 'Nama Barang Jadi',
			'harga' => 'Harga',
			'deskripsi' => 'Deskripsi',
			'is_delected' => 'Is Delected',
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

		$criteria->compare('id_barang_jadi',$this->id_barang_jadi);
		$criteria->compare('id_satuan',$this->id_satuan);
		$criteria->compare('kode_barang_jadi',$this->kode_barang_jadi,true);
		$criteria->compare('nama_barang_jadi',$this->nama_barang_jadi,true);
		$criteria->compare('harga',$this->harga,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);
		$criteria->compare('is_delected',$this->is_delected,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Barang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
