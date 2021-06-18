<?php
declare(strict_types=1);

namespace App\Components\Form\Member;


use App\Components\Form\Member\Exception\MemberFormException;
use Domain\Repository\MemberRepository;
use Nette\Application\UI\Form;
use Nette\Http\Request;

class MemberFormFactory
{
    public const MEMBER_ID = 'memberId';
    public const FIRST_NAME = 'firstName';
    public const LAST_NAME = 'lastName';
    public const FACR_ID = 'facrId';
    public const YEAR_OF_BIRTH = 'yearOfBirth';
    public const EMAIL = 'email';


    private MemberRepository $memberRepository;
    private Request $request;
    private MemberFormProcessor $memberFormProcessor;

    public function __construct(
        MemberRepository $memberRepository,
        Request $request,
        MemberFormProcessor $memberFormProcessor
    ) {
        $this->memberRepository = $memberRepository;
        $this->request = $request;
        $this->memberFormProcessor = $memberFormProcessor;
    }

    public function create(): Form
    {
        $form = new Form();
        $member = null;

        if (isset($this->request->getQuery()['memberId'])){
            $member = $this->memberRepository->findById((int)$this->request->getQuery()['memberId']);
        }

        $form->addHidden(self::MEMBER_ID, $member === null ? null : $member->getId());
        $form->addText(self::FIRST_NAME, 'Jméno')
            ->setDefaultValue($member === null ? null : $member->getFirstName())
            ->setRequired();
        $form->addText(self::LAST_NAME, 'Příjmení')
            ->setDefaultValue($member === null ? null : $member->getLastName())
            ->setRequired();
        $form->addText(self::FACR_ID, 'ID FAČR')
            ->setDefaultValue($member === null ? null : $member->getFacrId())
            ->setRequired();
        $form->addText(self::YEAR_OF_BIRTH, 'Rok narození')
            ->setDefaultValue($member === null ? null : $member->getYearOfBirth())
            ->setRequired();
        $form->addText(self::EMAIL, 'Email')
            ->setDefaultValue($member === null ? null : $member->getEmail())
            ->setHtmlType('email');
        $form->addSubmit('submit', 'submit');

        $form->onSuccess[] = function (Form $form){
            try {
                $this->memberFormProcessor->process($form);
                $form->getPresenter()->redirect('Member:default');
            } catch (MemberFormException $exception) {
                $form->getPresenter()->flashMessage($exception->getMessage(), 'alert alert-danger');
                $form->getPresenter()->redirect('this');
            }
        };

        return $form;
    }

}