<?php declare(strict_types=1);

namespace App\DTO;

use JMS\Serializer\Annotation as Serializer;
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
}
