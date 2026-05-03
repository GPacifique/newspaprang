<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Article;

class ArticleTicker extends Component
{
    public $articles;

    public function __construct()
    {
        $this->articles = Article::where('status', 'published')
            ->latest()
            ->take(10)
            ->get();
    }

    public function render()
    {
        return view('components.article-ticker');
    }
}
