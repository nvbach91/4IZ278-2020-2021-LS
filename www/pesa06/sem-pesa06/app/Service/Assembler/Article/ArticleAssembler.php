<?php
declare(strict_types=1);

namespace App\Service\Assembler\Article;


use App\Service\Assembler\Article\ValueObject\Article;
use Domain\Entity\ArticleEntity;
use Domain\Entity\TeamEntity;
use Domain\Repository\ArticleRepository;
use Domain\Repository\TeamRepository;

class ArticleAssembler
{
    private ArticleRepository $articleRepository;
    private TeamRepository $teamRepository;

    public function __construct(
        ArticleRepository $articleRepository,
        TeamRepository $teamRepository
    ) {
        $this->articleRepository = $articleRepository;
        $this->teamRepository = $teamRepository;
    }

    public function assembly(int $id): Article
    {
        /** @var ArticleEntity|null $entity */
        $entity = $this->articleRepository->find($id);
        if ($entity === null) {
            throw new ArticleAssemblerException('Article not found!');
        }
        $article = new Article();
        $article->setId($entity->getId());
        $article->setTitle($entity->getTitle());
        $article->setContent($entity->getValue());
        $article->setCreated($entity->getCreatedAt());
        $article->setAuthor($entity->getCreatedBy());
        if ($entity->getTeamId() !== null) {
            /** @var TeamEntity|null $team */
            $team = $this->teamRepository->find($entity->getTeamId());
            if ($team === null) {
                throw new ArticleAssemblerException('Team not found!');
            }
            $article->setTeamId($entity->getTeamId());
            $article->setTeamName($team->getName());
        }
        return $article;
    }
}