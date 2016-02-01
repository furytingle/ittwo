<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "students".
 *
 * @property integer $id
 * @property string $name
 *
 * @property StudentsCourses[] $studentsCourses
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentsCourses()
    {
        return $this->hasMany(StudentsCourses::className(), ['student_id' => 'id']);
    }

    public function getCourses()
    {
        return $this->hasMany(Courses::className(), ['id' => 'course_id'])
        ->viaTable(StudentsCourses::tableName(), ['student_id' => 'id'])
        ->all();
    }

    public function extraFields()
    {
        return ['studentsCourses' => function(){
            return $this->getCourses();
        }];
    }
}
