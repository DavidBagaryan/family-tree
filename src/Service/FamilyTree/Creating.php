<?php declare(strict_types=1);

namespace App\Service\FamilyTree;

use App\DTO\FamilyTreeData;
use App\Exception\FamilyTreeException;
use App\Message\FamilyTreeCreated;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\UuidV4;

class Creating
{
    private MessageBusInterface    $messageBus;
    private EntityManagerInterface $em;

    public function __construct(MessageBusInterface $messageBus, EntityManagerInterface $em)
    {
        $this->messageBus = $messageBus;
        $this->em = $em;
    }

    public function handle(FamilyTreeData $data): UuidV4
    {
        if ($data->members <= 0) {
            throw new FamilyTreeException('members count cannot be less than 1');
        }

        if (empty($data->surname)) {
            throw new FamilyTreeException('surname cannot be empty');
        }

        $uuid = UuidV4::v4();
        $ftCreated = new FamilyTreeCreated($uuid, $data->members, $data->surname);
        $this->em->persist($ftCreated());
        $this->em->flush();

        $this->messageBus->dispatch($ftCreated);
        return $uuid;
    }
}
