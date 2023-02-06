<?php


namespace MyProject\Controllers;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Views\View;
use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Services\EmailSendler;

class UserController
{
    private $view;

    public function __construct()
    {
        $this->view = new View('/../../../templates');
    }

    public function userProfile($userName){
        User::checkCookie();
        $result = User::findByOneColumn('nickname', $userName);

        if($result == []){
            $this->view->renderHtml('error/notFound.php');
            return;
        }

        $this->view->renderHtml('user/user.php', ['user' => $result]);
    }

    public function singUp()
    {
        User::resetCookie();

        if(!empty($_POST)){
            try{
                $user = User::reviewSingUp($_POST);
            }catch(InvalidArgumentException $e){
                $this->view->renderHtml('user/sing-up.php', ['error' => $e->getMessage()]);
                return;
            }
            
            if($user instanceof User){
                $code = UserActivationService::createActivationCode($user);

                EmailSendler::sendMail($user, 'Activation', 'userActivation.php', [

                ]);


            }
        }

        $this->view->renderHtml('user/sing-up.php');
    }


    public function login()
    {
        if(!empty($_POST)){
            try{
                User::login($_POST);
                header('location: http://mypsr/');
                return;
            }catch(InvalidArgumentException $e){
                $this->view->renderHtml('user/login.php', ['error' => $e->getMessage()]);
                return;
            }
        }

        $this->view->renderHtml('user/login.php');
    }

    public function exit(){
        ob_start();
            User::resetCookie();
        ob_end_clean();
        
        $this->view->renderHtml('user/exit.php');
    }
}

