<?php
declare(strict_types=1);

namespace App\Components\Form\Article;


use Domain\Entity\ArticleEntity;
use Domain\Repository\ArticleRepository;
use Nette\Application\UI\Form;
use Nette\Security\User;

class ArticleUpsertFormProcessor
{
    private ArticleRepository $articleRepository;
    private User $user;

    public function __construct(
        ArticleRepository $articleRepository,
        User $user
    ) {
        $this->articleRepository = $articleRepository;
        $this->user = $user;
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
            $article->setCreatedBy($this->user->getIdentity()->getData()['username']);
            $this->articleRepository->persist($article);
            return;
        }
        $article->setModifiedBy($this->user->getIdentity()->getData()['username']);
        $article->setModifiedAt(new \DateTime());
        $this->articleRepository->persist($article);
    }

}