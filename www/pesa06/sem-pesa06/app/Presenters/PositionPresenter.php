<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Components\Form\Position\PositionFormFactory;
use App\Components\Grid\PositionGridBuilder;
use App\Domain\Enum\RoleEnum;
use App\Handler\DeletePositionHandler;
use App\Handler\Exception\DeletePositionHandlerException;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class PositionPresenter extends LayoutPresenter
{
    private PositionGridBuilder $positionGridBuilder;
    private PositionFormFactory $positionFormFactory;
    private DeletePositionHandler $deletePositionHandler;

    public function __construct(
        PositionGridBuilder $positionGridBuilder,
        PositionFormFactory $positionFormFactory,
        DeletePositionHandler $deletePositionHandler
    ) {
        parent::__construct();
        $this->positionGridBuilder = $positionGridBuilder;
        $this->positionFormFactory = $positionFormFactory;
        $this->deletePositionHandler = $deletePositionHandler;
    }

    public function beforeRender(): void
    {
        parent::beforeRender();
        $isAdmin = false;
        foreach ($this->user->getRoles() as $role) {
            if ($role === RoleEnum::ROLE_ADMIN) {
                $isAdmin = true;
            }
        }
        if ($isAdmin === false) {
            $this->flashMessage('Na tuto akci nemáš oprávnění!', 'alert alert-danger');
            $this->redirect('Article:default');
        }
    }

    public function actionDeletePosition(?string $positionId): void
    {
        if ($positionId === null || $positionId === '') {
            $this->flashMessage('Position ID cannot be null!', 'alert alert-danger');
            $this->redirect('default');
        }
        try {
            $this->deletePositionHandler->handle((int)$positionId);
        } catch (DeletePositionHandlerException $e) {
            $this->flashMessage($e->getMessage(), 'alert alert-danger');
            $this->redirect('default');
        }
        $this->flashMessage('OK!', 'alert alert-success');
        $this->redirect('default');
    }

    public function createComponentPositionGrid(): IComponent
    {
        return $this->positionGridBuilder->build();
    }

    public function createComponentPositionForm(): Form
    {
        return $this->positionFormFactory->create();
    }

    public function actionEdit(?int $positionId): void
    {

    }
}