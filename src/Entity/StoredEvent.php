<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV4;

/**
 * @ORM\Entity()
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="event_type", type="string")
 * @ORM\DiscriminatorMap({
 *     "FamilyTreeCreated"=FamilyTreeCreated::class,
 *     "LocationsUpdated"=LocationsUpdated::class,
 *
 *     "AttemptToAddLessThanOneMemberFamilyTree"=AttemptToAddLessThanOneMemberFamilyTree::class,
 *     "AttemptToMakeEmptySurnameFamilyTree"=AttemptToMakeEmptySurnameFamilyTree::class
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
     * @ORM\Column(type="guid")
     */
    protected UuidV4 $familyTreeId;

    /**
     * @ORM\Column(type="json")
     */
    protected array $eventData;

    public function __construct(UuidV4 $ftId, array $eventData = [])
    {
        $this->familyTreeId = $ftId;
        $this->eventData = $eventData;
    }
}
