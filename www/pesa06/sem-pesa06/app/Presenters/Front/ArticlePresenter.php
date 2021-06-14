<?php
declare(strict_types=1);

namespace App\Presenters\Front;

use App\Service\Assembler\Article\ArticleAssembler;
use App\Service\Assembler\Article\ArticleAssemblerException;
use Dibi\Row;
use Domain\Repository\ArticleRepository;

class ArticlePresenter extends LayoutPresenter
{
    private ArticleAssembler $articleAssembler;
    private ArticleRepository $articleRepository;

    public function __construct(
        ArticleAssembler $articleAssembler,
        ArticleRepository $articleRepository
    )
    {
        parent::__construct();
        $this->articleAssembler = $articleAssembler;
        $this->articleRepository = $articleRepository;
    }

    public function actionDefault(int $page = 0): void
    {
        $this->template->page = $page;
        $this->template->maxPages = (int)floor(count($this->articleRepository->getAll()) / 4);
        $this->template->articles = array_map(function (Row $articleRow) {
            try {
                return $this->articleAssembler->assembly($articleRow['id'])->toArray();
            } catch (ArticleAssemblerException $e) {
                $this->flashMessage($e->getMessage(), 'alert alert-danger');
            }
        }, $this->articleRepository->findPagedIds($page));
    }

    public function actionDetail(int $id): void
    {
        try {
            $this->template->article = $this->articleAssembler->assembly($id)->toArray();
        } catch (ArticleAssemblerException $e) {
            $this->flashMessage($e->getMessage(), 'alert alert-danger');
            $this->redirect('Article:default');
        }
    }

}