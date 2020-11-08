<?php declare(strict_types=1);

namespace App\DTO;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Validator\Constraints as Assert;

class FamilyTreeData
{
    /**
     * @Serializer\Type("integer")
     * @Assert\NotBlank(groups={"create"})
     */
    public ?int $members = null;

    /**
     * @Serializer\Type("string")
     * @Assert\NotBlank(groups={"create"})
     */
    public ?string $surname = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $firstLocation = null;

    /**
     * @Serializer\Type("string")
     */
    public ?string $currentLocation = null;

    public function locations(UuidV4 $uuid): Locations
    {
        $locations = new Locations();
        $locations->uuid = $uuid;
        $locations->firstLocation = $this->firstLocation;
        $locations->currentLocation = $this->currentLocation;
        return $locations;
    }
}
