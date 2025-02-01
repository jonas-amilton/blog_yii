<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * RegisterForm is the model behind the register form.
 *
 * @property-read User|null $user
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $repeatPassword;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'repeatPassword'], 'required'],
            // password is validated by validatePassword()
            [['password', 'repeatPassword'], 'validatePassword'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Nome de usuário',
            'password' => 'Senha',
            'repeatPassword' => 'Repita a senha',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attributes, $params)
    {
        if (strlen($this->password) < 8 || strlen($this->repeatPassword < 8)) {
            $this->addError($attributes, 'A senha deve ter no mínimo 8 caracteres!');
        }

        if ($this->password != $this->repeatPassword) {
            $this->addError($attributes, 'Senhas devem ser iguais!');
        }

        if (!$this->hasErrors()) {
            $this->createUser();
        }
    }

    /**
     * Creates a new user.
     */
    private function createUser()
    {
        $user = new User();

        $user->username = $this->username;
        $user->password = self::encodePassword($this->password);
        $user->authKey = Yii::$app->security->generateRandomString();
        $user->accessToken = Yii::$app->security->generateRandomString();

        try {
            $user->save();
        } catch (\Throwable $th) {
            Yii::error("Erro ao criar usuário: " . $th->getMessage());
            return false;
        }
    }

    /**
     * Encodes the password.
     */
    private static function encodePassword($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }
}
