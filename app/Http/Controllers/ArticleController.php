<?php

namespace App\Http\Controllers;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = [['titre' => 'Titre1', 'auteur' => 'Auteur1', 'contenu' => 'Contenu1'],
            ['titre' => 'Titre2', 'auteur' => 'Auteur2', 'contenu' => 'Contenu2']];

        return view('articles', ['articles' => $articles]);
    }
}
