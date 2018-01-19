<?php

/**
 * This is the model class for table "proyek".
 *
 * The followings are the available columns in table 'proyek':
 * @property integer $id_proyek
 * @property string $nama_perusahaan
 * @property string $nama_proyek
 * @property string $alamat_proyek
 */
class Proyek extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'proyek';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_perusahaan, nama_proyek', 'length', 'max'=>50),
			array('alamat_proyek', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_proyek, nama_perusahaan, nama_proyek, alamat_proyek', 'safe', 'on'=>'search'),
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
			'id_proyek' => 'Id Proyek',
			'nama_perusahaan' => 'Nama Perusahaan',
			'nama_proyek' => 'Nama Proyek',
			'alamat_proyek' => 'Alamat Proyek',
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

		$criteria->compare('id_proyek',$this->id_proyek);
		$criteria->compare('nama_perusahaan',$this->nama_perusahaan,true);
		$criteria->compare('nama_proyek',$this->nama_proyek,true);
		$criteria->compare('alamat_proyek',$this->alamat_proyek,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Proyek the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
