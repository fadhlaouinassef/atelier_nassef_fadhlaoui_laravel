<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleCard extends Component
{
    /**
     * Create a new component instance.
     */
    public string $titre;

    public string $auteur;

    public function __construct(string $titre, string $auteur)
    {
        $this->titre = $titre;
        $this->auteur = $auteur;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article-card');
    }
}
