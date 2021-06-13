<?php
declare(strict_types=1);

namespace App\Components\Form\Position;


use Domain\Entity\PositionEntity;
use Domain\Repository\PositionRepository;
use Nette\Application\UI\Form;
use Nette\Security\User;

class PositionFormProcessor
{
    private PositionRepository $positionRepository;
    private User $user;

    public function __construct(
        PositionRepository $positionRepository,
        User $user
    ) {
        $this->positionRepository = $positionRepository;
        $this->user = $user;
    }

    public function process(Form $form): void
    {
        $values = $form->getValues();
        if ($values[PositionFormFactory::ID] !== '') {
            $position = $this->positionRepository->find((int)$values[PositionFormFactory::ID]);
        } else {
            $position = new PositionEntity();
            $position->setCreatedBy($this->user->getIdentity()->getData()['username']);
        }
        $position->setName($values[PositionFormFactory::NAME]);
        $this->positionRepository->persist($position);
    }
}