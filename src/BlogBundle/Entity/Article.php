<?php

class Article
{
    private $_id;
    private $_author_id;
    private $_title;
    private $_author;
    private $_category;
    private $_createdAt;
    private $_modifiedAt;
    private $_content;

    public function __construct(
        int $authorId,
        string $title,
        string $author,
        string $category,
        string $content
    )
    {
        $this->_author_id = $authorId;
        $this->_title = $title;
        $this->_author = $author;
        $this->_category = $category;
        $this->_createdAt = date('Y-m-d H:i:s');
        $this->_modifiedAt = date('Y-m-d H:i:s');
        $this->_content = $content;
    }

    public function getId(): string
    {
        return $this->_id;
    }

    public function setId(string $id): void
    {
        $this->_id = $id;
    }

    public function getAuthorId(): string
    {
        return $this->_author_id;
    }

    public function setAuthorId(string $authorId): void
    {
        $this->_authorId = $authorId;
    }

    public function getTitle(): string
    {
        return $this->_title;
    }

    public function setTitle(string $title): void
    {
        $this->_title = $title;
    }

    public function getAuthor(): string
    {
        return $this->_author;
    }

    public function setAuthor(string $author): void
    {
        $this->_author = $author;
    }

    public function getCategory(): string
    {
        return $this->_category;
    }

    public function setCategory(string $category): void
    {
        $this->_category = $category;
    }

    public function getContent(): string
    {
        return $this->_content;
    }

    public function setContent(string $content): void
    {
        $this->_content = $content;
    }

    public function getCreatedAt(): string
    {
        return $this->_createdAt;
    }

    public function getModifiedAt(): string
    {
        return $this->_modifiedAt;
    }

    public function setModifiedAt(string $modifiedAt): void
    {
        $this->_modifiedAt = $modifiedAt;
    }
}
