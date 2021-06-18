<?php

declare(strict_types=1);

namespace App\Router;

use Domain\Entity\ArticleEntity;
use Domain\Entity\TeamEntity;
use Domain\Repository\ArticleRepository;
use Domain\Repository\TeamRepository;
use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Routing\Route;


final class RouterFactory
{

    private array $cache = [];

    private TeamRepository $teamRepository;
    private ArticleRepository $articleRepository;

    public function __construct(
        TeamRepository $teamRepository,
        ArticleRepository $articleRepository
    )
    {
        $this->teamRepository = $teamRepository;
        $this->articleRepository = $articleRepository;
        foreach ($this->teamRepository->getAll() as $team) {
            $this->cache['teams'][strtolower(str_replace(' ', '-', $team->getName()))] = $team->getId();
        }
        /** @var ArticleEntity $article */
        foreach ($this->articleRepository->getAll() as $article) {
            $this->cache['articles'][strtolower(str_replace(' ', '-', $article->getTitle())) . '-' . $article->getCreatedAt()->format('YmdHis')] = $article->getId();
        }
    }

    public function createRouter(): RouteList
    {
        $router = new RouteList;
        $router->withModule('Front')
            ->addRoute('clanky', 'Article:default');
        $router->withModule('Front')
            ->addRoute('prihlaseni', 'Account:login');
        $router->withModule('Front')
            ->addRoute('clanky/<id>', [
                'presenter' => 'Article',
                'action' => 'detail',
                'id' => [
                    Route::FILTER_OUT => function (string $articleId): string {
                        $article = $this->articleRepository->find((int)$articleId);
                        return strtolower(str_replace(' ', '-', $article->getTitle())) . '-' . $article->getCreatedAt()->format('YmdHis');
                    },
                    Route::FILTER_IN => function (string $slug): int {
                        if (isset($this->cache['articles'][$slug])) {
                            return $this->cache['articles'][$slug];
                        } else {
                            return $this->cache['articles'][array_key_first($this->cache['articles'])];
                        }
                    }
                ]
            ]);
        $router->withModule('Front')
            ->addRoute('team/detail/<teamId>', [
                'presenter' => 'Team',
                'action' => 'detail',
                'teamId' => [
                    Route::FILTER_OUT => function (string $teamId): string {
                        /** @var TeamEntity $team */
                        $team = $this->teamRepository->find((int)$teamId);
                        return strtolower(str_replace(' ', '-', $team->getName()));
                    },
                    Route::FILTER_IN => function (string $team): int {
                        if (isset($this->cache['teams'][$team])) {
                            return $this->cache['teams'][$team];
                        } else {
                            return $this->cache['teams'][array_key_first($this->cache['teams'])];
                        }
                    }
                ]
            ]);
        $router->addRoute('<presenter>/<action>[/<id>]', 'Front:Article:default');
        $router->addRoute('/backoffice<presenter>/<action>[/<id>]', 'Backoffice:Article:default');

        $router[] = new Route('http://%host%/%basePath%/<module>/<presenter>/<action>', [
            'module' => 'Front',
            'presenter' => 'Article',
            'action' => 'default',
        ]);

        return $router;
    }
}
