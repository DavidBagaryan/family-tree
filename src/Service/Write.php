<?php declare(strict_types=1);

namespace App\Service;

use App\DTO\FamilyTreeData;
use App\DTO\Locations;
use App\Entity\FamilyTree;
use App\Exception\FamilyTreeException;
use App\Repository\FamilyTreeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Uid\Uuid;

class Write
{
    private EntityManagerInterface $em;
    private FamilyTreeRepository   $fTrees;

    public function __construct(EntityManagerInterface $em, FamilyTreeRepository $fTrees)
    {
        $this->em = $em;
        $this->fTrees = $fTrees;
    }

    public function getRecord(Uuid $uuid): FamilyTree
    {
        $ft = $this->fTrees->findOneBy(['uuid' => $uuid]);
        if (null === $ft) {
            throw EntityNotFoundException::fromClassNameAndIdentifier(FamilyTree::class, [$uuid]);
        }
        return $ft;
    }

    public function one(FamilyTreeData $data): FamilyTree
    {
        if ($data->members <= 0) {
            throw new FamilyTreeException('members count cannot be less than 1');
        }

        if (empty($data->surname)) {
            throw new FamilyTreeException('surname cannot be empty');
        }

        $ft = new FamilyTree($data->members, $data->surname);
        $this->em->persist($ft);
        $this->em->flush();

        $this->locations([$data->locations($ft->uuid())]);
        return $ft;
    }

    public function storedEvents(FamilyTree $ft): void
    {
        foreach ($ft->popEvents() as $event) {
            $this->em->persist($event);
        }
        $this->em->flush();
    }

    public function locations(array $data): void
    {
        foreach ($data as $locations) {
            /** @var Locations $locations */
            $ft = $this->getRecord($locations->uuid);
            $ft->updateLocations($locations->firstLocation, $locations->currentLocation);
        }
        $this->em->flush();
    }
}
