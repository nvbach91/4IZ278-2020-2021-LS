<?php
declare(strict_types=1);

namespace App\Components\Form\Staff;


use Domain\Entity\StaffEntity;
use App\Domain\Enum\StaffTypeEnum;
use Domain\Repository\MemberRepository;
use Domain\Repository\StaffRepository;
use Domain\Repository\TeamRepository;
use Nette\Application\UI\Form;
use Nette\Http\Request;

class StaffUpsertFormFactory
{
    public const ID = 'id';
    public const FIRST_NAME = 'firstName';
    public const LAST_NAME = 'lastName';
    public const MEMBER_ID = 'memberId';
    public const FACR_ID = 'facrId';

    private StaffRepository $staffRepository;
    private Request $request;
    private StaffUpsertFormProcessor $processor;
    private TeamRepository $teamRepository;
    private MemberRepository $memberRepository;

    public function __construct(
        StaffRepository $staffRepository,
        Request $request,
        StaffUpsertFormProcessor $processor,
        TeamRepository $teamRepository,
        MemberRepository $memberRepository
    ) {
        $this->processor = $processor;
        $this->request = $request;
        $this->staffRepository = $staffRepository;
        $this->teamRepository = $teamRepository;
        $this->memberRepository = $memberRepository;
    }

    public function create(): Form
    {
        $staff = null;
        $member = null;
        if (isset($this->request->getQuery()['staffId'])) {
            /** @var StaffEntity $staff */
            $staff = $this->staffRepository->find((int)$this->request->getQuery()['staffId']);
            if ($staff->getMemberId() !== null) {
                $member = $this->memberRepository->findById($staff->getMemberId());
                }
        }
        $form = new Form();
        $form->addHidden(self::ID, $staff === null ? null : $staff->getId());
        $form->addHidden(self::MEMBER_ID, $staff === null ? null : $staff->getMemberId())
            ->setHtmlId('memberId');
        $form->addText(self::FIRST_NAME, 'Jméno')
            ->setDefaultValue($staff === null ? null : $staff->getFirstName());
        $form->addText(self::LAST_NAME, 'Příjmení')
            ->setDefaultValue($staff === null ? null : $staff->getLastName());
        $form->addText(self::FACR_ID, '')
            ->setDefaultValue($member === null ? null : $member->getFacrId());
        $form->addSubmit('submit', 'Odeslat');
        $form->onSuccess[] = function (Form $form) {
            $this->processor->process($form);
            $form->getPresenter()->redirect('Staff:default');
        };
        return $form;
    }

}