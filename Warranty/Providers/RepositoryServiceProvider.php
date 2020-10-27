<?php

namespace Modules\Warranty\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Warranty\Entities\ExchangeItems\Repositories\ExchangeItemRepository;
use Modules\Warranty\Entities\ExchangeItems\Repositories\Interfaces\ExchangeItemRepositoryInterface;
use Modules\Warranty\Entities\ItemFailures\Repositories\ItemFailureRepository;
use Modules\Warranty\Entities\ItemFailures\Repositories\Interfaces\ItemFailureRepositoryInterface;
use Modules\Warranty\Entities\NotRepairedWarranties\Repositories\NotRepairedWarrantyRepository;
use Modules\Warranty\Entities\NotRepairedWarranties\Repositories\Interfaces\NotRepairedWarrantyRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCaseComments\Repositories\WarrantyCaseCommentRepository;
use Modules\Warranty\Entities\WarrantyCaseComments\Repositories\Interfaces\WarrantyCaseCommentRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCases\Repositories\WarrantyCaseRepository;
use Modules\Warranty\Entities\WarrantyCases\Repositories\Interfaces\WarrantyCaseRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCaseStatuses\Repositories\WarrantyCaseStatusRepository;
use Modules\Warranty\Entities\WarrantyCaseStatuses\Repositories\Interfaces\WarrantyCaseStatusRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCitationComments\Repositories\WarrantyCitationCommentRepository;
use Modules\Warranty\Entities\WarrantyCitationComments\Repositories\Interfaces\WarrantyCitationCommentRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCitations\Repositories\WarrantyCitationRepository;
use Modules\Warranty\Entities\WarrantyCitations\Repositories\Interfaces\WarrantyCitationRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCreditNoteComments\Repositories\WarrantyCreditNoteCommentRepository;
use Modules\Warranty\Entities\WarrantyCreditNoteComments\Repositories\Interfaces\WarrantyCreditNoteCommentRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCreditNotes\Repositories\WarrantyCreditNoteRepository;
use Modules\Warranty\Entities\WarrantyCreditNotes\Repositories\Interfaces\WarrantyCreditNoteRepositoryInterface;
use Modules\Warranty\Entities\WarrantyDocuments\Repositories\WarrantyDocumentRepository;
use Modules\Warranty\Entities\WarrantyDocuments\Repositories\Interfaces\WarrantyDocumentRepositoryInterface;
use Modules\Warranty\Entities\WarrantyFeedbackQuestions\Repositories\WarrantyFeedbackQuestionRepository;
use Modules\Warranty\Entities\WarrantyFeedbackQuestions\Repositories\Interfaces\WarrantyFeedbackQuestionRepositoryInterface;
use Modules\Warranty\Entities\WarrantyManagers\Repositories\WarrantyManagerRepository;
use Modules\Warranty\Entities\WarrantyManagers\Repositories\Interfaces\WarrantyManagerRepositoryInterface;
use Modules\Warranty\Entities\WarrantySolutions\Repositories\WarrantySolutionRepository;
use Modules\Warranty\Entities\WarrantySolutions\Repositories\Interfaces\WarrantySolutionRepositoryInterface;
use Modules\Warranty\Entities\WarrantyTypes\Repositories\WarrantyTypeRepository;
use Modules\Warranty\Entities\WarrantyTypes\Repositories\Interfaces\WarrantyTypeRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {

        $this->app->bind(
            ExchangeItemRepository::class,
            ExchangeItemRepositoryInterface::class
        );

        $this->app->bind(
            ItemFailureRepository::class,
            ItemFailureRepositoryInterface::class
        );

        $this->app->bind(
            NotRepairedWarrantyRepository::class,
            NotRepairedWarrantyRepositoryInterface::class
        );

        $this->app->bind(
            WarrantyCaseCommentRepository::class,
            WarrantyCaseCommentRepositoryInterface::class
        );

        $this->app->bind(
            WarrantyCaseRepository::class,
            WarrantyCaseRepositoryInterface::class
        );

        $this->app->bind(
            WarrantyCaseStatusRepository::class,
            WarrantyCaseStatusRepositoryInterface::class
        );

        $this->app->bind(
            WarrantyCitationCommentRepository::class,
            WarrantyCitationCommentRepositoryInterface::class
        );

        $this->app->bind(
            WarrantyCitationRepository::class,
            WarrantyCitationRepositoryInterface::class
        );

        $this->app->bind(
            WarrantyCreditNoteRepository::class,
            WarrantyCreditNoteRepositoryInterface::class
        );

        $this->app->bind(
            WarrantyCreditNoteCommentRepository::class,
            WarrantyCreditNoteCommentRepositoryInterface::class
        );

        $this->app->bind(
            WarrantyDocumentRepository::class,
            WarrantyDocumentRepositoryInterface::class
        );

        $this->app->bind(
            WarrantyFeedbackQuestionRepository::class,
            WarrantyFeedbackQuestionRepositoryInterface::class
        );

        $this->app->bind(
            WarrantyManagerRepository::class,
            WarrantyManagerRepositoryInterface::class
        );

        $this->app->bind(
            WarrantySolutionRepository::class,
            WarrantySolutionRepositoryInterface::class
        );

        $this->app->bind(
            WarrantyTypeRepository::class,
            WarrantyTypeRepositoryInterface::class
        );
    }
}