<?php declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Uid\UuidV4;

class Locations
{
    public UuidV4  $uuid;
    public ?string $firstLocation;
    public ?string $currentLocation;
}
