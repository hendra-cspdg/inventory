<?php

/**
 * This is the model class for table "barang_saldo".
 *
 * The followings are the available columns in table 'barang_saldo':
 * @property integer $id_barang_saldo
 * @property integer $id_barang
 * @property string $kode_saldo
 * @property string $tgl_saldo
 * @property string $jumlah_saldo
 * @property string $is_deleted
 * @property string $keterangan
 */
class BarangSaldo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'barang_saldo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_barang, tgl_saldo, jumlah_saldo', 'required'),
			array('id_barang', 'numerical', 'integerOnly'=>true),
			array('kode_saldo', 'length', 'max'=>20),
			array('jumlah_saldo', 'length', 'max'=>6),
			array('is_deleted', 'length', 'max'=>2),
			array('keterangan', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_barang_saldo, id_barang, kode_saldo, tgl_saldo, jumlah_saldo, is_deleted, keterangan', 'safe', 'on'=>'search'),
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
			'id_barang_saldo' => 'Id Barang Saldo',
			'id_barang' => 'Id Barang',
			'kode_saldo' => 'Kode Saldo',
			'tgl_saldo' => 'Tgl Saldo',
			'jumlah_saldo' => 'Jumlah Saldo',
			'is_deleted' => 'Is Deleted',
			'keterangan' => 'Keterangan',
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

		$criteria->compare('id_barang_saldo',$this->id_barang_saldo);
		$criteria->compare('id_barang',$this->id_barang);
		$criteria->compare('kode_saldo',$this->kode_saldo,true);
		$criteria->compare('tgl_saldo',$this->tgl_saldo,true);
		$criteria->compare('jumlah_saldo',$this->jumlah_saldo,true);
		$criteria->compare('is_deleted',$this->is_deleted,true);
		$criteria->compare('keterangan',$this->keterangan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BarangSaldo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
