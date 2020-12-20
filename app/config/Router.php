<?php

require_once __DIR__ . "/../../src/BlogBundle/Controller/MainController.php";

$request = $_SERVER['REQUEST_URI'];
$mainCtrl = new MainController();

switch ($request) {
    case '/':
        $response = $mainCtrl->homeAction();
        break;
    case '/login':
        $response = $mainCtrl->loginAction();
        break;
    case '/inscription':
        $response = $mainCtrl->inscriptionAction();
        break;
    case '/validateInscription':
        $response = $mainCtrl->validateInscriptionAction();
        break;
    case '/verificationLogin':
        $response = $mainCtrl->validationLoginAction();
        break;
    case '/addArticle':
        $response = $mainCtrl->addArticlesAction();
        break;
    case '/admin':
        $response = $mainCtrl->adminAction();
        break;
    case '/deconnexion':
        $response = $mainCtrl->deconnexionAction();
        break;
    case '/deleteArticle?id=' . $_GET['id']:
        $response = $mainCtrl->deleteArticle($_GET['id']);
        break;
    case '/editArticle?id=' . $_GET['id']:
        $response = $mainCtrl->editArticle($_GET['id']);
        break;
    case '/validateEdit?id=' . $_GET['id']:
        $response = $mainCtrl->validateEdit($_GET['id']);
        break;
    default:
        $response = $mainCtrl->notFoundAction();
}
