<?php


namespace MyProject\Services;


use MyProject\Models\Users\User;


class EmailSendler
{
    public static function sendMail(
        User $receiver,
        string $subject,
        string $templateName,
        array $templateVar = []
    ):void{
        extract($templateVar);


        ob_start();
        require __DIR__ . '/../../../templates/mail/' . $templateName;
        $body = ob_get_contents();
        ob_end_clean();

        mail($receiver->getEmail(), $subject, $body, 'Content-Type: text/html; charset=UTF-8');
    }
}