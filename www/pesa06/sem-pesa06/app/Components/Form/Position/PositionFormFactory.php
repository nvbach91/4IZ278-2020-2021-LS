<?php
declare(strict_types=1);

namespace App\Components\Form\Position;


use Domain\Entity\PositionEntity;
use Domain\Repository\PositionRepository;
use Nette\Application\UI\Form;
use Nette\Http\Request;

class PositionFormFactory
{
    public const ID = 'id';
    public const NAME = 'name';

    private PositionRepository $positionRepository;
    private Request $request;
    private PositionFormProcessor $processor;

    public function __construct(
        PositionRepository $positionRepository,
        Request $request,
        PositionFormProcessor $processor
    ) {
        $this->positionRepository = $positionRepository;
        $this->request = $request;
        $this->processor = $processor;
    }

    public function create(): Form
    {
        $form = new Form();
        $id = $this->request->getQuery('positionId');
        $position = null;
        if ($id !== null && $id !== '') {
            /** @var PositionEntity $position */
            $position = $this->positionRepository->find((int)$id);
        }
        $form->addHidden(self::ID, $id);
        $form->addText(self::NAME, 'Název')
            ->setRequired()
            ->setDefaultValue($position === null ? null : $position->getName());
        $form->addSubmit('submit', 'Odeslat');
        $form->onSuccess[] = function (Form $form) {
            $this->processor->process($form);
            $form->getPresenter()->redirect('Position:default');
        };
        return $form;
    }
}