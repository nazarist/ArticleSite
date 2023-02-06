<?php


namespace MyProject\Models\Articles;

use InvalidArgumentException;
use MyProject\Models\ActiverecordEntity;
use MyProject\Models\Users\User;


class Article extends ActiverecordEntity
{
    protected $authorId;
    protected $title;
    protected $text;
    protected $createAt;


    public function setTitle($title): void
    {
        $this->title = $title;
    }


    public function setAuthorId($authorId): void
    {
        $this->authorId = $authorId;
    }


    public function setText($text): void
    {
        $this->text = $text;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function getText()
    {
        return $this->text;
    }


    public function getAuthor()
    {
        return User::getById($this->authorId);
    }

    
    
    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function getCreateAt()
    {
        return $this->createAt;
    }


    public function getDateAsWord()
    {
        $dateAndTime = explode(' ', $this->createAt);
        return date('F d', strtotime($dateAndTime[0]));// changing datetime format to word
    }


    public function getPortionText() // отримати частину тексту 
    {
        $pieceText = substr($this->text, 0, 100);
        return preg_replace('~ \S+$~', '...', $pieceText);
    }


    public static function reviewArticle($post)
    {
        $title = static::cleaningString($post['title']);
        $text = static::cleaningString($post['text']);


        if(empty($title)){
            throw new InvalidArgumentException('input title is empty');
        }elseif(static::checkLenght($title, 40, 200)){
            throw new InvalidArgumentException('title must hahe from 400 to 200 sumbols');
        }

        if(empty($text)){
            throw new InvalidArgumentException('input text is empty');
        }elseif(static::checkLenght($text, 100, 10000)){
            throw new InvalidArgumentException('text must hahe from 100 to 10,000 sumbols');
        }

        $article = new Article();
        $article->setAuthorId(2);
        $article->setTitle($title);
        $article->setText($text);
        var_dump($article);
        $article->save();
    }



    protected static function getTableName(){
        return 'articles';
    }
}