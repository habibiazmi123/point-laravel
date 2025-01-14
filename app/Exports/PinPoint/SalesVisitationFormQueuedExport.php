<?php

namespace App\Exports\PinPoint;

use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SalesVisitationFormQueuedExport implements WithMultipleSheets, ShouldQueue
{
    use Exportable;
    protected $userId;
    protected $dateFrom;
    protected $dateTo;
    protected $branchId;
    protected $cloudStorageId;

    /**
     * ScaleWeightItemExport constructor.
     *
     * @param string $dateFrom
     * @param string $dateTo
     */
    public function __construct($userId, string $dateFrom, string $dateTo, $branchId, $cloudStorageId)
    {
        $this->dateFrom = date('Y-m-d 00:00:00', strtotime($dateFrom));
        $this->dateTo = date('Y-m-d 23:59:59', strtotime($dateTo));
        $this->branchId = $branchId;
        $this->cloudStorageId = $cloudStorageId;
        $this->userId = $userId;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new SalesVisitationFormSheet($this->userId, $this->dateFrom, $this->dateTo, $this->branchId, $this->cloudStorageId);
        $sheets[] = new InterestReasonSheet($this->userId, $this->dateFrom, $this->dateTo, $this->branchId, $this->cloudStorageId);
        $sheets[] = new NoInterestReasonSheet($this->userId, $this->dateFrom, $this->dateTo, $this->branchId, $this->cloudStorageId);
        $sheets[] = new SimilarProductSheet($this->userId, $this->dateFrom, $this->dateTo, $this->branchId, $this->cloudStorageId);
        $sheets[] = new ItemSoldSheet($this->userId, $this->dateFrom, $this->dateTo, $this->branchId, $this->cloudStorageId);

        return $sheets;
    }
}
