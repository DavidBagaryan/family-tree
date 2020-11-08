<?php declare(strict_types=1);

namespace App\MessageHandler;

use App\Entity\FamilyTree;
use App\Message\FamilyTreeCreated;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class FamilyTreeCreatedHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function __invoke(FamilyTreeCreated $message)
    {
        $ft = new FamilyTree($message->uuid());
        $ft->newFamily($message->members(), $message->surname());
        $this->em->persist($ft);
        $this->em->flush();
    }
}
