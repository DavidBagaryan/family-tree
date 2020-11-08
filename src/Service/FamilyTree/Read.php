<?php declare(strict_types=1);

namespace App\Service\FamilyTree;

use App\Entity\FamilyTree;
use App\Repository\FamilyTreeRepository;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Uid\UuidV4;

class Read
{
    private FamilyTreeRepository $fTrees;

    public function __construct(FamilyTreeRepository $fTrees)
    {
        // can be replaced by the other read FT implementation
        $this->fTrees = $fTrees;
    }

    public function one(UuidV4 $uuid): FamilyTree
    {
        $ft = $this->fTrees->findOneBy(['uuid' => $uuid]);
        if (null === $ft) {
            throw EntityNotFoundException::fromClassNameAndIdentifier(FamilyTree::class, [$uuid]);
        }
        return $ft;
    }
}
