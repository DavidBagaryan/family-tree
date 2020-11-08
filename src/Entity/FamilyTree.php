<?php declare(strict_types=1);

namespace App\Entity;

use App\DTO\FamilyTreeData;
use App\Repository\FamilyTreeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV4;

/**
 * @ORM\Entity(repositoryClass=FamilyTreeRepository::class)
 */
class FamilyTree
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = 0;

    /**
     * @ORM\Column(type="guid", unique=true)
     */
    private UuidV4 $uuid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private int $members;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $surname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $firstLocation = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $currentLocation = null;

    public function __construct(UuidV4 $uuid)
    {
        $this->uuid = $uuid;
    }

    public function newFamily(int $members, string $surname): void
    {
        $this->members = $members;
        $this->surname = $surname;
    }

    public function data(): FamilyTreeData
    {
        $data = new FamilyTreeData();
        $data->surname = $this->surname;
        $data->members = $this->members;
        $data->firstLocation = $this->firstLocation;
        $data->currentLocation = $this->currentLocation;
        return $data;
    }
}
