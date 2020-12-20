<?php

require_once __DIR__ . '/../../../app/config/DbHandler.php';
require_once __DIR__ . '/../Entity/Article.php';

class ArticleRepository
{
    private $_db;

    public function __construct()
    {
        $this->_db = DbHandler::getDb();
    }

    public function findAll()
    {
        $results = $this->_db->prepare("SELECT * FROM article");
        $results->execute();

        $articles_from_table = $results->fetchAll();

        foreach ($articles_from_table as $article){
            $articleObj = $this->convertToObject($article);
            $articleObj->setId($article['id']);
            $articles[] = $articleObj;
        }

        return $articles;
    }
    
    public function findArticleByUser()
    {
        $results = $this->_db->prepare("SELECT * FROM article WHERE :id = `user_id`");
        $results->execute([':id' => $_SESSION['id_user']]);

        $articles_from_table = $results->fetchAll();

        foreach ($articles_from_table as $article){
            $articleObj = $this->convertToObject($article);
            $articleObj->setId($article['id']);
            $articles[] = $articleObj;
        }

        return $articles;
    }


    public function deleteArticle($id)
    {
        $results = $this->_db->prepare("DELETE FROM article WHERE id = :id");
        $results->execute([':id' => $id]);

        if ($results) {
            return true;
        }

        return false;
    }

    public function addArticle(Article $article)
    {
        $result = $this->_db->prepare(
            "INSERT INTO article (user_id, title, author, category, content, createdAt, modifiedAt) 
          VALUE (:user_id, :title, :author, :category, :content, :createdAt, :modifiedAt)");

        $result->execute([
            ':user_id' => $_SESSION['id_user'],
            ':title' => $article->getTitle(),
            ':author' => $article->getAuthor(),
            ':category' => $article->getCategory(),
            ':content' => $article->getContent(),
            ':createdAt' => $article->getCreatedAt(),
            ':modifiedAt' => $article->getModifiedAt()
        ]);

        if ($result) {
            return true;
        }

        return false;
    }

    public function editArticle(Article $article)
    {
        $result = $this->_db->prepare("UPDATE article SET title = :title, category = :category, content = :content, modifiedAt = :modifiedAt WHERE id = :id");
        $result->execute([
            ':title' => $article->getTitle(),
            ':category' => $article->getCategory(),
            ':content' => $article->getContent(),
            ':modifiedAt' => date('Y-m-d'),
            ':id' => $article->getId()
        ]);

        if ($result) {
            return true;
        }

        return false;
    }

    public function findOneById($id)
    {
        $results = $this->_db->prepare("SELECT * FROM Article WHERE id = :id");
        $results->execute([':id' => $id]);

        $articles_from_tables = $results->fetchAll();

        $count = count($articles_from_tables);

        if ($count === 1) {
            return $this->convertToObject($articles_from_tables[0]);
        }

        return false;
    }

    private function convertToObject(array $article)
    {
        return new Article(
            $article['user_id'],
            $article['title'],
            $article['author'],
            $article['category'],
            $article['content']);
    }
}