<?php
declare(strict_types=1);

namespace App\Components\Form\Staff;


use App\Domain\Entity\StaffEntity;
use App\Domain\Repository\StaffRepository;
use Nette\Application\UI\Form;

class StaffUpsertFormProcessor
{
    private StaffRepository $staffRepository;

    public function __construct(
        StaffRepository $staffRepository
    ) {
        $this->staffRepository = $staffRepository;
    }

    public function process(Form $form): void
    {
        $values = $form->getValues();
        $oldStaff = $this->staffRepository->find((int)$values[StaffUpsertFormFactory::ID]);
        $staff = $oldStaff === null ? new StaffEntity() : $oldStaff;
        $staff->setFirstName($values[StaffUpsertFormFactory::FIRST_NAME]);
        $staff->setLastName($values[StaffUpsertFormFactory::LAST_NAME]);
        $staff->setPosition($values[StaffUpsertFormFactory::POSITION]);
        $staff->setMemberId(empty($values[StaffUpsertFormFactory::MEMBER_ID]) ? null : (int)$values[StaffUpsertFormFactory::MEMBER_ID]);
        $staff->setTeamId(empty($values[StaffUpsertFormFactory::TEAM_ID]) ? null : (int)$values[StaffUpsertFormFactory::TEAM_ID]);
        if ($oldStaff === null) {
            $staff->setCreatedAt(new \DateTime());
            $staff->setCreatedBy('admin');
            $this->staffRepository->persist($staff);
            return;
            }
        $staff->setModifiedAt(new \DateTime());
        $staff->setModifiedBy('admin');
        $this->staffRepository->persist($staff);
    }

}