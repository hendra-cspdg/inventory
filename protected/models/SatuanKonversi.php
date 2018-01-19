<?php

/**
 * This is the model class for table "satuan_konversi".
 *
 * The followings are the available columns in table 'satuan_konversi':
 * @property integer $id_satuan_konversi
 * @property integer $id_satuan
 * @property integer $id_satuan_bawah
 * @property string $nama_konversi
 * @property string $jumlah_atas
 * @property string $jumlah_bawah
 */
class SatuanKonversi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'satuan_konversi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_satuan, id_satuan_bawah', 'numerical', 'integerOnly'=>true),
			array('nama_konversi', 'length', 'max'=>50),
			array('jumlah_atas, jumlah_bawah', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_satuan_konversi, id_satuan, id_satuan_bawah, nama_konversi, jumlah_atas, jumlah_bawah', 'safe', 'on'=>'search'),
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
			'id_satuan_konversi' => 'Id Satuan Konversi',
			'id_satuan' => 'Id Satuan',
			'id_satuan_bawah' => 'Id Satuan Bawah',
			'nama_konversi' => 'Nama Konversi',
			'jumlah_atas' => 'Jumlah Atas',
			'jumlah_bawah' => 'Jumlah Bawah',
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

		$criteria->compare('id_satuan_konversi',$this->id_satuan_konversi);
		$criteria->compare('id_satuan',$this->id_satuan);
		$criteria->compare('id_satuan_bawah',$this->id_satuan_bawah);
		$criteria->compare('nama_konversi',$this->nama_konversi,true);
		$criteria->compare('jumlah_atas',$this->jumlah_atas,true);
		$criteria->compare('jumlah_bawah',$this->jumlah_bawah,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SatuanKonversi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
