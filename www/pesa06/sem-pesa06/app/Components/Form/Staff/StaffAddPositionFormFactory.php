<?php
declare(strict_types=1);

namespace App\Components\Form\Staff;


use Domain\Entity\StaffPositionTeamEntity;
use Domain\Repository\PositionRepository;
use Domain\Repository\StaffPositionTeamRepository;
use Domain\Repository\TeamRepository;
use Nette\Application\UI\Form;
use Nette\Http\Request;

class StaffAddPositionFormFactory
{
    public const STAFF_ID = 'staff_id';
    public const ID = 'id';
    public const TEAM_ID = 'team_id';
    public const POSITION_ID = 'position_id';

    private TeamRepository $teamRepository;
    private PositionRepository $positionRepository;
    private StaffAddPositionFormProcessor $processor;
    private Request $request;
    private StaffPositionTeamRepository $staffPositionTeamRepository;

    public function __construct(
        TeamRepository $teamRepository,
        PositionRepository $positionRepository,
        StaffAddPositionFormProcessor $processor,
        Request $request,
        StaffPositionTeamRepository $staffPositionTeamRepository
    ) {
        $this->teamRepository = $teamRepository;
        $this->positionRepository = $positionRepository;
        $this->processor = $processor;
        $this->request = $request;
        $this->staffPositionTeamRepository = $staffPositionTeamRepository;
    }

    public function create(): Form
    {
        $id = $this->request->getQuery('pairingId');
        $staffId = $this->request->getQuery('staffId');
        $pairing = null;
        if ($id !== null) {
            /** @var StaffPositionTeamEntity $pairing */
            $pairing = $this->staffPositionTeamRepository->find((int)$id);
        }
        $form = new Form();
        $form->addHidden(self::ID, $id);
        $form->addHidden(self::STAFF_ID, $staffId);
        $form->addSelect(self::POSITION_ID, 'Pozice', $this->positionRepository->fetchPairs('id', 'name'))
            ->setDefaultValue($pairing === null ? null : $pairing->getPositionId());
        $form->addSelect(self::TEAM_ID, 'Tým', ['' => '---'] + $this->teamRepository->fetchPairs('id', 'name'))
            ->setDefaultValue($pairing === null ? null : $pairing->getTeamId());
        $form->addSubmit('submit', 'submit');
        $form->onSuccess[] = function (Form $form) {
            $staffId = $this->processor->process($form);
            $form->getPresenter()->redirect('Staff:upsert', ['staffId' => $staffId]);
        };
        return $form;
    }
}