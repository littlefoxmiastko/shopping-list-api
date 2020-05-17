<?php
declare(strict_types=1);

namespace App\Modules\Http;


use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

class Paginator
{
    /** @var int */
    private $totalItems;

    /** @var float */
    private $pages;

    /** @var int */
    private $currentItems;

    /**
     * @return int
     */
    public function getTotalItems(): int
    {
        return $this->totalItems;
    }

    /**
     * @return float
     */
    public function getPagesCount(): float
    {
        return $this->pages;
    }

    public function getCurrentItems(): int
    {
        return $this->currentItems;
    }
    /**
     * @param QueryBuilder $queryBuilder
     * @param int $page
     * @param int $size
     * @return DoctrinePaginator
     * @throws \Exception
     */
    public function paginate(QueryBuilder $queryBuilder, int $page, int $size): DoctrinePaginator
    {
        $paginator = new DoctrinePaginator($queryBuilder);
        $this->totalItems = $paginator->count();
        $this->pages = ceil($this->getTotalItems()/$size);
        $paginator->getQuery()
            ->setMaxResults($size)
            ->setFirstResult($size*($page-1));
        $this->currentItems = $paginator->getIterator()->count();

        return $paginator;
    }

}