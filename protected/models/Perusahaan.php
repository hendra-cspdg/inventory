<?php

/**
 * This is the model class for table "perusahaan".
 *
 * The followings are the available columns in table 'perusahaan':
 * @property integer $id_perusahaan
 * @property string $nama_perusahaan
 * @property string $alamat_perusahaan
 * @property string $no_telephone
 */
class Perusahaan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'perusahaan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_perusahaan, alamat_perusahaan', 'length', 'max'=>100),
			array('no_telephone', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_perusahaan, nama_perusahaan, alamat_perusahaan, no_telephone', 'safe', 'on'=>'search'),
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
			'id_perusahaan' => 'Id Perusahaan',
			'nama_perusahaan' => 'Nama Perusahaan',
			'alamat_perusahaan' => 'Alamat Perusahaan',
			'no_telephone' => 'No Telephone',
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

		$criteria->compare('id_perusahaan',$this->id_perusahaan);
		$criteria->compare('nama_perusahaan',$this->nama_perusahaan,true);
		$criteria->compare('alamat_perusahaan',$this->alamat_perusahaan,true);
		$criteria->compare('no_telephone',$this->no_telephone,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Perusahaan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
