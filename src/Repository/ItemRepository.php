<?php
declare(strict_types=1);

namespace App\Repository;
use App\Entity\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class ItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, $entityClass=null)
    {
        parent::__construct($registry, Item::class);
    }


    public function findAllQueryBuilder(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('i');
        $qb->orderBy('i.id');

        return $qb;
    }
}