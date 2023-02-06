<?php

namespace MyProject\Controllers;


use myProject\Views\View;
use MyProject\Models\Articles\Article;

class MainController
{
    private $viev;


    public function __construct()
    {
        $this->viev = new View('/../../../templates');
    }


    public function main()
    {
        $allArticles = Article::findAll();
        $this->viev->renderHtml('main/mainMenu.php', ['articles' => $allArticles]);
    }
    
}