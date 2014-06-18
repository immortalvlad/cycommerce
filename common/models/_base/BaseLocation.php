<?php

/**
 * This is the model base class for the table "location".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Location".
 *
 * Columns in table "location" available as properties of the model,
 * followed by relations of table "location" available as properties of the model.
 *
 * @property integer $id
 * @property string $name
 * @property string $locationCode
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
 * @property string $note
 * @property integer $status
 * @property string $create_at
 * @property string $lastedit_at
 *
 * @property LocationGroup[] $locationGroups
 */
abstract class BaseLocation extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'location';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Location|Locations', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name, locationCode, create_at', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('name, locationCode, email, city, state', 'length', 'max'=>128),
			array('phone, fax, country', 'length', 'max'=>50),
			array('zip', 'length', 'max'=>20),
			array('address, note, lastedit_at', 'safe'),
			array('phone, fax, email, address, city, state, zip, country, note, status, lastedit_at', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, name, locationCode, phone, fax, email, address, city, state, zip, country, note, status, create_at, lastedit_at', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'locationGroups' => array(self::HAS_MANY, 'LocationGroup', 'location_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'name' => Yii::t('app', 'Name'),
			'locationCode' => Yii::t('app', 'Location Code'),
			'phone' => Yii::t('app', 'Phone'),
			'fax' => Yii::t('app', 'Fax'),
			'email' => Yii::t('app', 'Email'),
			'address' => Yii::t('app', 'Address'),
			'city' => Yii::t('app', 'City'),
			'state' => Yii::t('app', 'State'),
			'zip' => Yii::t('app', 'Zip'),
			'country' => Yii::t('app', 'Country'),
			'note' => Yii::t('app', 'Note'),
			'status' => Yii::t('app', 'Status'),
			'create_at' => Yii::t('app', 'Create At'),
			'lastedit_at' => Yii::t('app', 'Lastedit At'),
			'locationGroups' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('locationCode', $this->locationCode, true);
		$criteria->compare('phone', $this->phone, true);
		$criteria->compare('fax', $this->fax, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('address', $this->address, true);
		$criteria->compare('city', $this->city, true);
		$criteria->compare('state', $this->state, true);
		$criteria->compare('zip', $this->zip, true);
		$criteria->compare('country', $this->country, true);
		$criteria->compare('note', $this->note, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('create_at', $this->create_at, true);
		$criteria->compare('lastedit_at', $this->lastedit_at, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}