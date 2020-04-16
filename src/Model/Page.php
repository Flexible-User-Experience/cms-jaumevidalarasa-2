<?php

namespace App\Model;

class Page
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $article;

    /**
     * Page constructor.
     *
     * @param string $title
     * @param string $article
     */
    public function __construct(string $title, string $article)
    {
        $this->title = $title;
        $this->article = $article;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): Page
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getArticle(): string
    {
        return $this->article;
    }

    /**
     * @param string $article
     *
     * @return $this
     */
    public function setArticle(string $article): Page
    {
        $this->article = $article;

        return $this;
    }
}
