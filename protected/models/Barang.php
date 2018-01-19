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
class Barang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'barang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_satuan', 'numerical', 'integerOnly'=>true),
			array('kode_barang', 'length', 'max'=>20),
			array('nama_barang, merk', 'length', 'max'=>50),
			array('deskripsi', 'length', 'max'=>200),
			array('is_deleted', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_barang, id_satuan, kode_barang, nama_barang, merk, deskripsi, is_deleted', 'safe', 'on'=>'search'),
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
			'id_barang' => 'Id Barang',
			'id_satuan' => 'Id Satuan',
			'kode_barang' => 'Kode Barang',
			'nama_barang' => 'Nama Barang',
			'merk' => 'Merk',
			'deskripsi' => 'Deskripsi',
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

		$criteria->compare('id_barang',$this->id_barang);
		$criteria->compare('id_satuan',$this->id_satuan);
		$criteria->compare('kode_barang',$this->kode_barang,true);
		$criteria->compare('nama_barang',$this->nama_barang,true);
		$criteria->compare('merk',$this->merk,true);
		$criteria->compare('deskripsi',$this->deskripsi,true);	
		$criteria->compare('is_deleted',$this->is_deleted,true);

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
