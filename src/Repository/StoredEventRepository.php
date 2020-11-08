<?php

namespace App\Repository;

use App\Entity\StoredEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StoredEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method StoredEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method StoredEvent[]    findAll()
 * @method StoredEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StoredEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StoredEvent::class);
    }
}
