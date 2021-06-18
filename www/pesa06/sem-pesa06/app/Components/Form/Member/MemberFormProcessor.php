<?php
declare(strict_types=1);

namespace App\Components\Form\Member;


use App\Components\Form\Member\Exception\MemberFormException;
use Domain\Entity\MemberEntity;
use Domain\Repository\MemberRepository;
use DateTime;
use Nette\Application\UI\Form;

class MemberFormProcessor
{
    private MemberRepository $memberRepository;

    public function __construct(
        MemberRepository $memberRepository
    )
    {
        $this->memberRepository = $memberRepository;
    }

    public function process(Form $form): void
    {
        $values = $form->getValues();
        $storedMember = $this->memberRepository->findById((int)$values[MemberFormFactory::MEMBER_ID]);
        $member = $storedMember === null ? new MemberEntity() : $storedMember;
        $member->setFirstName($values[MemberFormFactory::FIRST_NAME]);
        $member->setLastName($values[MemberFormFactory::LAST_NAME]);
        if (strlen(ltrim(rtrim($values[MemberFormFactory::FACR_ID]))) !== 8 || !is_numeric(ltrim(rtrim($values[MemberFormFactory::FACR_ID])))) {
            throw new MemberFormException('Facr ID must be number with length of 8!');
        }
        if ($storedMember === null) {
            if ($this->memberRepository->findByFacrId((int)$values[MemberFormFactory::FACR_ID])) {
                throw new MemberFormException('Member with this FACR ID already exists!');
            }
        } else {
            if ($storedMember->getFacrId() !== $values[MemberFormFactory::FACR_ID]) {
                if ($this->memberRepository->findByFacrId((int)$values[MemberFormFactory::FACR_ID])) {
                    throw new MemberFormException('Member with this FACR ID already exists!');
                }
            }
        }
        $member->setFacrId($values[MemberFormFactory::FACR_ID]);
        $today = new DateTime();
        if ((int)$values[MemberFormFactory::YEAR_OF_BIRTH] < 1900 || (int)$values[MemberFormFactory::YEAR_OF_BIRTH] > (int)$today->format('Y')) {
            throw new MemberFormException('This year of birth is not valid! Year of birth cannot be lower than 1900 or higher than this year.');
        }
        $member->setYearOfBirth((int)$values[MemberFormFactory::YEAR_OF_BIRTH]);
        if ($values[MemberFormFactory::EMAIL] !== '') {
            if (!filter_var($values[MemberFormFactory::EMAIL], FILTER_VALIDATE_EMAIL)) {
                throw new MemberFormException('Field email has to contain valid email address!');
            }
            $member->setEmail($values[MemberFormFactory::EMAIL]);
        }

        if ($storedMember === null) {
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