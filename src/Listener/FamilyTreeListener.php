<?php declare(strict_types=1);

namespace App\Listener;

use App\Entity\FamilyTree;
use App\Service\Write;
use Doctrine\ORM\Event\LifecycleEventArgs;

class FamilyTreeListener
{
    private Write $write;

    public function __construct(Write $write)
    {
        $this->write = $write;
    }

    public function postPersist(FamilyTree $ft, LifecycleEventArgs $args): void
    {
        $this->write->storedEvents($ft);
    }

    public function postUpdate(FamilyTree $ft, LifecycleEventArgs $args): void
    {
        $this->write->storedEvents($ft);
    }
}
