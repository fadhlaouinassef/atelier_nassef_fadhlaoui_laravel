<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Articles</title>
    @vite('resources/css/app.css')
</head>
<body class="workshop-page">
    <main class="page-container">
        <h1>Articles</h1>

        <x-alert type="success">Un article a été créé avec succès.</x-alert>
        <x-alert type="error">Une erreur peut empêcher la publication d'un article.</x-alert>
        <x-alert type="info">Découvrez les derniers articles ci-dessous.</x-alert>

        <section class="article-list" aria-label="Liste des articles">
            @foreach ($articles as $article)
                <x-article-card :titre="$article['titre']" :auteur="$article['auteur']">
                    {{ $article['contenu'] }}
                </x-article-card>
            @endforeach
        </section>
    </main>
</body>
</html>
