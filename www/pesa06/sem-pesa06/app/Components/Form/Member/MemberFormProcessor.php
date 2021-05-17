<?php
declare(strict_types=1);

namespace App\Components\Form\Member;


use Domain\Entity\MemberEntity;
use Domain\Repository\MemberRepository;
use DateTime;
use Nette\Application\UI\Form;

class MemberFormProcessor
{
    private MemberRepository $memberRepository;

    public function __construct(
        MemberRepository $memberRepository
    ) {
        $this->memberRepository = $memberRepository;
    }

    public function process(Form $form): void
    {
        $values = $form->getValues();
        $storedMember = $this->memberRepository->findById((int)$values[MemberFormFactory::MEMBER_ID]);
        $member = $storedMember === null ? new MemberEntity() : $storedMember;
        $member->setFirstName($values[MemberFormFactory::FIRST_NAME]);
        $member->setLastName($values[MemberFormFactory::LAST_NAME]);
        $member->setFacrId($values[MemberFormFactory::FACR_ID]);
        $member->setYearOfBirth((int)$values[MemberFormFactory::YEAR_OF_BIRTH]);
        $member->setEmail($values[MemberFormFactory::EMAIL]);

        if ($storedMember === null){
            $member->setCreatedAt(new DateTime());
            $member->setCreatedBy('admin');
            $this->memberRepository->store($member);
            return;
        }

        $member->setModifiedAt(new DateTime());
        $member->setModifiedBy('admin');
        $this->memberRepository->store($member);

    }

}