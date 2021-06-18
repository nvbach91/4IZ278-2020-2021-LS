<?php
declare(strict_types=1);

namespace App\Components\Form\Team;


use Domain\Repository\TeamRepository;
use Nette\Application\UI\Form;
use Nette\Http\Request;

class TeamFormFactory
{
    public const ID = 'id';
    public const NAME = 'name';
    public const AGE_UNDER = 'age_under';
    public const COMPETITION = 'competition';
    public const IS_YOUTH = 'is_youth';

    private TeamRepository $teamRepository;
    private Request $request;
    private TeamFormProcessor $processor;

    public function __construct(
        TeamRepository $teamRepository,
        Request $request,
        TeamFormProcessor $processor
    ) {
        $this->teamRepository = $teamRepository;
        $this->request = $request;
        $this->processor = $processor;
    }

    public function create(): Form
    {
        $form = new Form();

        $team = null;
        if (isset($this->request->getQuery()['teamId'])){
            $team = $this->teamRepository->findById((int)$this->request->getQuery()['teamId']);
        }

        $form->addHidden(self::ID, $team === null ? null : $team->getId());
        $form->addText(self::NAME, 'Jméno')
            ->setDefaultValue($team === null ? null : $team->getName());
        $form->addText(self::AGE_UNDER, 'Věk do')
            ->setDefaultValue($team === null ? null : $team->getAgeUnder());
        $form->addText(self::COMPETITION, 'Soutěž')
            ->setDefaultValue($team === null ? null : $team->getCompetition());
        $form->addCheckbox(self::IS_YOUTH, 'Mládež')
            ->setDefaultValue($team === null ? null : $team->isYouth());
        $form->addSubmit('submit', 'Odeslat');
        $form->onSuccess[] = function (Form $form){
            $this->processor->process($form);
            $form->getPresenter()->redirect('Team:default');
        };
        return $form;
    }

}