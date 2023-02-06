<?php


namespace MyProject\Controllers;


use MyProject\Exceptions\NotRegisterException;
use MyProject\Models\Users\User;
use InvalidArgumentException;
use MyProject\Models\Articles\Article;
use MyProject\Views\View;
use MyProject\Exceptions\NotFoundException;

class ArticlesController
{

    
    private $view;


    public function __construct()
    {
        $this->view = new View('/../../../templates');
    }
    
    public function articles($articleId)
    {   
        $article = Article::getById($articleId);

        if($article === null){
            throw new NotFoundException('Article is not found');
        }

        $this->view->renderHtml('articles/articles.php', ['articles' => $article]);
    }

    public function create()
    {
        $user = User::checkCookie();
        $error = '';
        if($user->getRole() === 'user'){
            throw new notRegisterException('you are dont have access to create article');
        }
        if(!empty($_POST)){
            try{
                Article::reviewArticle($_POST);
                header('Location: http://mypsr/');
                return;
            }catch(InvalidArgumentException $e){
                $error = $e->getMessage();
            }
        }

        $this->view->renderHtml('articles/createArticles.php', ['error' => $error]);
    }
}