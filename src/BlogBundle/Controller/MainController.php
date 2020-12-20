<?php

require_once __DIR__ . '/../Repository/ArticleRepository.php';
require_once __DIR__ . '/../Repository/UsersRepository.php';

class MainController
{
    private $path_of_views = __DIR__ . "/../Resources/views";

    public function __construct()
    {
        if (isset($_SESSION['id_user'])){
            $this->user = (new UsersRepository())->findUserById($_SESSION['id_user']);
            $this->user->setId($_SESSION['id_user']);
        }
    }

    public function homeAction()
    {
        $articles = (new ArticleRepository())->findAll();

        $response = array(
            "view" => $this->path_of_views . "/home.php",
            "attributes" => [
                "articles" => $articles
            ]
        );

        return $response;
    }

    public function loginAction($error = "")
    {
        $response = array(
            "view" => $this->path_of_views . "/login.php",
            "error" => $error
        );

        return $response;
    }

    
    public function deconnexionAction()
    {
        bonjour;
    }

    public function inscriptionAction($error = "")
    {
        $response = array(
            "view" => $this->path_of_views . "/inscription.php",
            "error" => $error
        );

        return $response;
    }

    public function validateInscriptionAction()
    {
        $result = (new UsersRepository())->addUser($_POST);

        if ($result === true) {
            header('Location: /login');
        } else {
            header('Location: /inscription');
        }
    }

    public function validationLoginAction()
    {
        $pseudo = $_POST['pseudo'];
        $password = $_POST['password'];

        $result = (new UsersRepository())->findUser($pseudo, $password);

        if ($result !== false) {
            $_SESSION['ROLE'] = 'USER';
            $_SESSION['id_user'] = $result[0]['id'];
            header('Location: /');
        } else {
            header('Location: /login');
        }
    }

    public function addArticlesAction()
    {
        $author = $this->user->getNom() .' '.$this->user->getPrenom();
        $newArticle = new Article($this->user->getId(), $_POST['title'], $author, $_POST['category'], $_POST['content']);
        $result = (new ArticleRepository())->addArticle($newArticle);

        if ($result === true) {
            header('Location: /');
        } else {
            header('Location: /admin');
        }
    }

    public function adminAction()
    {

        $articles = (new ArticleRepository())->findArticleByUser();

        $response = array(
            "view" => $this->path_of_views . "/admin.php",
            "attributes" => [
                "articles" => $articles
            ]
        );

        return $response;
    }

    public function deleteArticle($id)
    {
        $result = (new ArticleRepository())->deleteArticle($id);

        if ($result === true) {
            header('Location: /admin');
        } else {
            header('Location: /admin');
        }
    }

    public function notFoundAction()
    {
        $response = array(
            "view" => $this->path_of_views . "/404.php",
            "attributes" => []
        );
        return $response;
    }

    public function editArticle($id)
    {
        $article = (new ArticleRepository())->findOneById($id);
        $article->setId($id);

        $response = array(
            "view" => $this->path_of_views . "/edit_article.php",
            "attributes" => [
                "article" => $article
            ]
        );

        return $response;
    }

    public function validateEdit($id)
    {
        $author = $this->user->getNom() .' '.$this->user->getPrenom();
        $article = new Article($this->user->getId(), $_POST['title'], $author, $_POST['category'], $_POST['content']);

        $article->setId($id);

        $editArticle = (new ArticleRepository())->editArticle($article);

        if ($editArticle === true) {
            header('Location: /admin');
        } else {
            header('Location: /admin');
        }
    }
}
