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
        bdump($this->articleRepository->findPagedIds($page));
        $this->template->articles = array_map(function (Row $articleRow) {
            try {
                return $this->articleAssembler->assembly($articleRow['id'])->toArray();
            } catch (ArticleAssemblerException $e) {
                $this->flashMessage($e->getMessage(), 'alert alert-danger');
                //TODO
                $this->redirect('');
            }
        }, $this->articleRepository->findPagedIds($page));
        bdump($this->template->articles);
    }

}