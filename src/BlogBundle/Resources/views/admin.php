<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.png" type="image/png">
    <title>TP PHP Blog</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="/">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/admin">Admin</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container mt-3 text-center style="width:30%">
    <h1>Page d'administration</h1><br>
    <h3>Suppression d'un article :</h2><br><br>

    <?php foreach ($attributes['articles'] as $article): ?>
        <article>
            <h1><?= $article->getTitle() ?></h1>
            <div class="meta-data">
                <p class="author"><strong>Auteur :</strong> <?= $article->getAuthor() ?></p>
                <p class="category"><strong>Catégorie :</strong> <?= $article->getCategory() ?></p>
                <p class="creation-date"><strong>Date :</strong> <?= $article->getCreatedAt() ?></p>
                <a class="btn btn-dark" href="/deleteArticle?id=<?= $article->getId() ?>">Supprimer l'article</a>
                <a class="btn btn-dark" href="/editArticle?id=<?= $article->getId() ?>">Modifier l'article</a>
            </div>

        </article>

    <?php endforeach; ?>
</div>

</body>

<footer class="my-5 pt-5 text-muted text-center text-small">
  <p class="mb-1">&copy; 2020-2021 PRAT Florian</p>
</footer>
</html>