<?php
declare(strict_types=1);

namespace App\Modules\Http\Model;


class ResponseHeader
{
    /** @var string  */
    public const HEADER_TOTAL_ITEMS = 'X-Total-Items';

    /** @var string  */
    public const HEADER_PAGES_COUNT = 'X-Pages';

    /** @var string  */
    public const HEADER_CURRENT_PAGE = 'X-Current-Page';

    /** @var string  */
    public const HEADER_CURRENT_PAGE_ITEMS = 'X-Current-Page-Items';

    /** @var int */
    private $totalItems;

    /** @var float */
    private $pagesCount;

    /** @var int */
    private $currentPage;

    /** @var int */
    private $currentPageItems;

    /**
     * @return int
     */
    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    /**
     * @param int $totalItems
     */
    public function setTotalItems(int $totalItems): void
    {
        $this->totalItems = $totalItems;
    }

    /**
     * @return float
     */
    public function getPagesCount(): float
    {
        return $this->pagesCount;
    }

    /**
     * @param float $pagesCount
     */
    public function setPagesCount(float $pagesCount): void
    {
        $this->pagesCount = $pagesCount;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     */
    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    /**
     * @return int
     */
    public function getCurrentPageItems(): int
    {
        return $this->currentPageItems;
    }

    /**
     * @param int $currentPageItems
     */
    public function setCurrentPageItems(int $currentPageItems): void
    {
        $this->currentPageItems = $currentPageItems;
    }

    public function toArray():array
    {
        return [

        ];
    }
}