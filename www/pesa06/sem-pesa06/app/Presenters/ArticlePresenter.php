<?php
declare(strict_types=1);

namespace App\Presenters;


use App\Components\Form\Article\ArticleUpsertFormFactory;
use App\Components\Grid\ArticleGridBuilder;
use Domain\Repository\TeamRepository;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class ArticlePresenter extends LayoutPresenter
{
    private ArticleUpsertFormFactory $articleUpsertFormFactory;
    private ArticleGridBuilder $articleGridBuilder;

    public function __construct(
        ArticleGridBuilder $articleGridBuilder,
        ArticleUpsertFormFactory $articleUpsertFormFactory,
        TeamRepository $teamRepository
    ) {
        parent::__construct($teamRepository);
        $this->articleGridBuilder = $articleGridBuilder;
        $this->articleUpsertFormFactory = $articleUpsertFormFactory;
    }

    public function createComponentArticleGrid(): IComponent
    {
        return $this->articleGridBuilder->build();
    }

    public function createComponentArticleUpsertForm(): Form
    {
        return $this->articleUpsertFormFactory->create();
    }

}