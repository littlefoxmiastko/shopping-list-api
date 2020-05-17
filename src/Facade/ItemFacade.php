<?php
declare(strict_types=1);

namespace App\Facade;

use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;

class ItemFacade
{
    /** @var EntityManagerInterface  */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createItem(string $name, string $unit, int $quantity, bool $done = false): void
    {
        $item = new Item();
        $item->setName($name);
        $item->setUnit($unit);
        $item->setQuantity($quantity);
        $item->setDone($done);

        $this->entityManager->persist($item);
        $this->entityManager->flush();
    }

    public function removeItem(Item $item): void
    {
        $this->entityManager->remove($item);
        $this->entityManager->flush();
    }
}