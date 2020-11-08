<?php declare(strict_types=1);

namespace App\Service;

use App\DTO\FamilyTreeData;
use App\Entity\FamilyTree;
use Doctrine\ORM\EntityManagerInterface;

class Write
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function one(FamilyTreeData $data): FamilyTree
    {
        $ft = new FamilyTree();
        $ft->initiate($data)
           ->updateLocations($data->firstLocation, $data->currentLocation);

        $this->em->persist($ft);
        $this->em->flush();
        return $ft;
    }

    public function storedEvents(FamilyTree $ft): void
    {
        foreach ($ft->popEvents() as $event) {
            $this->em->persist($event);
        }
        $this->em->flush();
    }
}
