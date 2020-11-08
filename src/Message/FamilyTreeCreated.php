<?php declare(strict_types=1);

namespace App\Message;

use Symfony\Component\Uid\UuidV4;

final class FamilyTreeCreated
{
    private UuidV4 $uuid;
    private int    $members;
    private string $surname;

    public function __construct(UuidV4 $uuid, int $members, string $surname)
    {
        $this->uuid = $uuid;
        $this->members = $members;
        $this->surname = $surname;
    }

    public function __invoke(): \App\Entity\FamilyTreeCreated
    {
        return new \App\Entity\FamilyTreeCreated($this->uuid, [
            'members' => $this->members,
            'surname' => $this->surname,
        ]);
    }

    public function uuid(): UuidV4
    {
        return $this->uuid;
    }

    public function members(): int
    {
        return $this->members;
    }

    public function surname(): string
    {
        return $this->surname;
    }
}
