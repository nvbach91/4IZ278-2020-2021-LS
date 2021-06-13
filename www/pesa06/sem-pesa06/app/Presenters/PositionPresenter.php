<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Components\Form\Position\PositionFormFactory;
use App\Components\Grid\PositionGridBuilder;
use App\Domain\Enum\RoleEnum;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class PositionPresenter extends LayoutPresenter
{
    private PositionGridBuilder $positionGridBuilder;
    private PositionFormFactory $positionFormFactory;

    public function __construct(
        PositionGridBuilder $positionGridBuilder,
        PositionFormFactory $positionFormFactory
    ) {
        parent::__construct();
        $this->positionGridBuilder = $positionGridBuilder;
        $this->positionFormFactory = $positionFormFactory;
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