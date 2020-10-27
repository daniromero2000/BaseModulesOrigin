<?php

namespace Modules\Warranty\Entities\WarrantyCases;

use Modules\Warranty\Entities\WarrantyFeedbackQuestions\WarrantyFeedbackQuestion;
use Modules\Warranty\Entities\NotRepairedWarranties\NotRepairedWarranty;
use Modules\Warranty\Entities\WarrantyCaseComments\WarrantyCaseComment;
use Modules\Warranty\Entities\WarrantyCaseStatuses\WarrantyCaseStatus;
use Modules\Warranty\Entities\WarrantyCreditNotes\WarrantyCreditNote;
use Modules\Warranty\Entities\WarrantyCitations\WarrantyCitation;
use Modules\Warranty\Entities\WarrantySolutions\WarrantySolution;
use Modules\Warranty\Entities\WarrantyDocuments\WarrantyDocument;
use Modules\Warranty\Entities\WarrantyManagers\WarrantyManager;
use Modules\Warranty\Entities\WarrantyChanges\WarrantyChange;
use Modules\Warranty\Entities\WarrantyTypes\WarrantyType;
use Modules\Warranty\Entities\ItemFailures\ItemFailure;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarrantyCase extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'employee_id',
        'invoice',
        'invoice_total',
        'product_reference',
        'product_serial',
        'product_name',
        'product_price',
        'product_date_purchase',
        'product_sale_lote',
        'type_purchase',
        'subsidiary_id',
        'item_failure_id',
        'failure_description',
        'product_state',
        'product_accesories',
        'product_ubication',
        'warranty_manager_id',
        'warranty_type_id',
        'reason_deneid',
        'warranty_solution_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function creditNote()
    {
        return $this->hasOne(WarrantyCreditNote::class);
    }

    public function citation()
    {
        return $this->hasOne(WarrantyCitation::class);
    }

    public function comments()
    {
        return $this->hasMany(WarrantyCaseComment::class);
    }

    public function statuses()
    {
        return $this->belongsToMany(WarrantyCaseStatus::class);
    }

    public function notRepairedWarranty()
    {
        return $this->hasOne(NotRepairedWarranty::class);
    }

    public function documents()
    {
        return $this->belongsToMany(WarrantyDocument::class);
    }

    public function warrantyChange()
    {
        return $this->hasOne(WarrantyChange::class);
    }

    public function feedbacks()
    {
        return $this->belongsToMany(WarrantyFeedbackQuestion::class);
    }

    public function itemFailure()
    {
        return $this->belongsTo(ItemFailure::class);
    }

    public function warrantyManager()
    {
        return $this->belongsTo(WarrantyManager::class);
    }

    public function warrantySolution()
    {
        return $this->belongsTo(WarrantySolution::class);
    }

    public function warrantyType()
    {
        return $this->belongsTo(WarrantyType::class);
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class);
    }
}