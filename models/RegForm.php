<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $login
 * @property string|null $password
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $fio
 * @property int|null $role_id
 *
 * @property Report[] $reports
 * @property Role $role
 */
class RegForm extends User
{
    public $passwordConfirm;
    public $agree;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id'], 'integer'],
            [['login', 'password', 'email', 'phone', 'fio'], 'required', 'message' => 'Поле должно быть заполнено'],
            [['email'], 'email', 'message' => 'Неверная форма почты'],
            [['passwordConfirm'], 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
            [['agree'], 'compare', 'compareValue' => True, 'message' => 'Персональные данные должны быть подтверждены'],
            [['login', 'password', 'email', 'phone', 'fio'], 'string', 'max' => 255],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Пароль',
            'passwordConfirm' => 'Подтвердите пароль',
            'agree' => 'Подтвердите персональные данные',
            'email' => 'Email',
            'phone' => 'Телефон',
            'fio' => 'ФИО',
            'role_id' => 'Role ID',
        ];
    }
}
