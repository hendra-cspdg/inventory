<?php

/**
 * This is the model class for table "permintaan_barang_detail".
 *
 * The followings are the available columns in table 'permintaan_barang_detail':
 * @property integer $id_permintaan_barang_detail
 * @property integer $id_permintaan_barang
 * @property integer $id_barang
 * @property string $jumlah_barang
 * @property string $keterangan
 * @property string $is_deleted
 */
class PermintaanBarangDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'permintaan_barang_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_permintaan_barang, id_barang', 'numerical', 'integerOnly'=>true),
			array('jumlah_barang', 'length', 'max'=>10),
			array('keterangan', 'length', 'max'=>100),
			array('is_deleted', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_permintaan_barang_detail, id_permintaan_barang, id_barang, jumlah_barang, keterangan, is_deleted', 'safe', 'on'=>'search'),
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
			'id_permintaan_barang_detail' => 'Id Permintaan Barang Detail',
			'id_permintaan_barang' => 'Id Permintaan Barang',
			'id_barang' => 'Id Barang',
			'jumlah_barang' => 'Jumlah Barang',
			'keterangan' => 'Keterangan',
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

		$criteria->compare('id_permintaan_barang_detail',$this->id_permintaan_barang_detail);
		$criteria->compare('id_permintaan_barang',$this->id_permintaan_barang);
		$criteria->compare('id_barang',$this->id_barang);
		$criteria->compare('jumlah_barang',$this->jumlah_barang,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('is_deleted',$this->is_deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PermintaanBarangDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
