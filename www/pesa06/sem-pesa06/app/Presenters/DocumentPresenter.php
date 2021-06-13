<?php
declare(strict_types=1);

namespace App\Presenters;


use App\Components\Form\Document\CreateDocumentForMemberFormFactory;
use App\Components\Form\Document\CreateDocumentForTeamFormFactory;
use App\Components\Grid\DocumentGridBuilder;
use App\Domain\Enum\RoleEnum;
use App\Handler\Pdf\Exception\PdfExportHandlerException;
use App\Handler\Pdf\PdfExportHandler;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class DocumentPresenter extends LayoutPresenter
{
    private DocumentGridBuilder $documentGridBuilder;
    private CreateDocumentForTeamFormFactory $createDocumentForTeamFormFactory;
    private CreateDocumentForMemberFormFactory $createDocumentForMemberFormFactory;
    private PdfExportHandler $pdfExportHandler;

    public function __construct(
        DocumentGridBuilder $documentGridBuilder,
        CreateDocumentForTeamFormFactory $createDocumentForTeamFormFactory,
        CreateDocumentForMemberFormFactory $createDocumentForMemberFormFactory,
        PdfExportHandler $pdfExportHandler
    ) {
        parent::__construct();
        $this->documentGridBuilder = $documentGridBuilder;
        $this->createDocumentForTeamFormFactory = $createDocumentForTeamFormFactory;
        $this->createDocumentForMemberFormFactory = $createDocumentForMemberFormFactory;
        $this->pdfExportHandler = $pdfExportHandler;
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

    public function createComponentDocumentGrid(): IComponent
    {
        return $this->documentGridBuilder->build();
    }

    public function createComponentCreateForTeamForm(): Form
    {
        return $this->createDocumentForTeamFormFactory->create();
    }

    public function createComponentCreateForMemberForm(): Form
    {
        return $this->createDocumentForMemberFormFactory->create();
    }

    public function actionExport(int $documentId): void
    {
        try {
            $this->pdfExportHandler->handle($documentId);
        } catch (PdfExportHandlerException $e) {
            $this->flashMessage($e->getMessage(), 'alert alert-danger');
            $this->redirect('Document:default');
        }
    }

}