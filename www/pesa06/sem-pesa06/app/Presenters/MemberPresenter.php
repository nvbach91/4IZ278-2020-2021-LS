<?php
declare(strict_types=1);

namespace App\Presenters;


use App\Components\Form\Member\MemberFormFactory;
use App\Components\Grid\MemberGridBuilder;
use Domain\Repository\MemberRepository;
use Domain\Repository\PlayerRepository;
use Domain\Repository\TeamRepository;
use App\Service\Import\MemberXlsImportService;
use Nette\Application\Responses\JsonResponse;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\ComponentModel\IComponent;

class MemberPresenter extends LayoutPresenter
{
    private MemberGridBuilder $memberGridBuilder;
    private MemberFormFactory $memberFormFactory;
    private MemberXlsImportService $memberXlsImportService;
    private MemberRepository $memberRepository;

    public function __construct(
        MemberGridBuilder $memberGridBuilder,
        MemberFormFactory $memberFormFactory,
        MemberXlsImportService $memberXlsImportService,
        MemberRepository $memberRepository,
        TeamRepository $teamRepository
    )
    {
        parent::__construct($teamRepository);
        $this->memberGridBuilder = $memberGridBuilder;
        $this->memberFormFactory = $memberFormFactory;
        $this->memberXlsImportService = $memberXlsImportService;
        $this->memberRepository = $memberRepository;
    }

    public function createComponentMemberGrid(): IComponent
    {
        return $this->memberGridBuilder->build();
    }

    public function createComponentUpsertMemberForm(): Form
    {
        return $this->memberFormFactory->create();
    }

    public function actionImport(): void
    {
        $this->memberXlsImportService->import();
        $this->redirect('Member:default');
    }

    public function actionSuggestMember(string $firstName, string $lastName): array
    {
        $result = $this->memberRepository->suggest($firstName, $lastName);
        if (isset($result['error'])) {
            if ($result['error'] === true) {
                $this->sendResponse(new JsonResponse(['error' => true]));
            }
        }
        $this->sendResponse(new JsonResponse($result));
    }

    public function actionUpsert(?int $memberId): void
    {

    }

}