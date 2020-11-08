<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\StoredEventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV4;

/**
 * @ORM\Entity(repositoryClass=StoredEventRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="event_type", type="string")
 * @ORM\DiscriminatorMap({
 *     "FamilyTreeCreated"=FamilyTreeCreated::class
 * })
 */
abstract class StoredEvent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected UuidV4 $aggregateUUID;

    /**
     * @ORM\Column(type="json")
     */
    protected array $eventData = [];

    public function __construct(UuidV4 $uuidV4, array $eventData)
    {
        $this->aggregateUUID = $uuidV4;
        $this->eventData = $eventData;
    }
}
