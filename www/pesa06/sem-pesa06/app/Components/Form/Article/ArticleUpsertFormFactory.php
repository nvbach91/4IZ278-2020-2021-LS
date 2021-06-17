<?php
declare(strict_types=1);

namespace App\Components\Form\Article;


use Domain\Repository\ArticleRepository;
use Domain\Repository\TeamRepository;
use Nette\Application\UI\Form;
use Nette\Http\Request;

class ArticleUpsertFormFactory
{
    public const ID = 'id';
    public const TEAM_ID = 'team_id';
    public const TITLE = 'title';
    public const VALUE = 'value';

    private ArticleUpsertFormProcessor $processor;
    private ArticleRepository $articleRepository;
    private Request $request;
    private TeamRepository $teamRepository;

    public function __construct(
        ArticleUpsertFormProcessor $processor,
        ArticleRepository $articleRepository,
        Request $request,
        TeamRepository $teamRepository
    ) {
        $this->request = $request;
        $this->articleRepository = $articleRepository;
        $this->processor = $processor;
        $this->teamRepository = $teamRepository;
    }

    public function create(): Form
    {
        $article = null;
        if (isset($this->request->getQuery()['articleId'])) {
            $article = $this->articleRepository->findById((int)$this->request->getQuery()['articleId']);
        }
        $form = new Form();
        $form->addHidden(self::ID, $article === null ? null : $article->getId());
        $form->addText(self::TITLE, 'Nadpis')
            ->setRequired()
            ->setDefaultValue($article === null ? null : $article->getTitle());
        $form->addSelect(self::TEAM_ID, 'Tým', ['' => 'Bez týmu'] + $this->teamRepository->fetchPairs('id', 'name'))
            ->setDefaultValue($article === null ? null : $article->getTeamId());
        $form->addTextArea(self::VALUE, 'Text')
            ->setDefaultValue($article === null ? null : $article->getValue());
        $form->addSubmit('submit', 'Uložit');

        $form->onSuccess[] = function (Form $form) {
            $this->processor->process($form);
            $form->getPresenter()->redirect('Article:default');
        };
        return $form;
    }

}