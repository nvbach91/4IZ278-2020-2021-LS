<?php
declare(strict_types=1);

namespace App\Components\Form\Article;


use App\Domain\Entity\ArticleEntity;
use App\Domain\Repository\ArticleRepository;
use Nette\Application\UI\Form;

class ArticleUpsertFormProcessor
{
    private ArticleRepository $articleRepository;

    public function __construct(
        ArticleRepository $articleRepository
    ) {
        $this->articleRepository = $articleRepository;
    }

    public function process(Form $form): void
    {
        $values = $form->getValues();
        $oldArticle = $this->articleRepository->findById((int)$values[ArticleUpsertFormFactory::ID]);
        $article = $oldArticle === null ? new ArticleEntity() : $oldArticle;
        $article->setTitle($values[ArticleUpsertFormFactory::TITLE]);
        $article->setTeamId(empty($values[ArticleUpsertFormFactory::TEAM_ID]) ? null : (int)$values[ArticleUpsertFormFactory::TEAM_ID]);
        $article->setValue($values[ArticleUpsertFormFactory::VALUE]);
        if ($oldArticle === null) {
            $article->setCreatedAt(new \DateTime());
            $article->setCreatedBy('admin');
            $this->articleRepository->persist($article);
            return;
        }
        $article->setModifiedBy('admin');
        $article->setModifiedAt(new \DateTime());
        $this->articleRepository->persist($article);
    }

}