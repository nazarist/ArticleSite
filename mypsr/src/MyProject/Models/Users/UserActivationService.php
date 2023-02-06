<?php

namespace MyProject\Models\Users;


use MyProject\Services\Db;

class UserActivationService
{
    private const TABLE_NAME = 'user_activation_code';


    public static function createActivationCode(User $user): string{

        $code = bin2hex(random_bytes(16));


        Db::getInstans()->query(
            'INSERT INTO `' . self::TABLE_NAME . '` (user_id, code) VALUES (:user_id, :code);',
            [
                'user_id' => $user->getId(),
                'code' => $code
            ]
        );

        return $code;
    }

    public static function checkActivationCode(User $user, string $code){
        $result = Db::getInstans()->query(
            'SELECT * FROM `' . self::TABLE_NAME .'` WHERE user_id = :user_id AND code = :code',
            [
                'user_id' => $user->getId(),
                'code' => $code
            ]
        );

        return !empty($result);
    }
}