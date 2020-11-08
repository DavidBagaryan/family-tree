<?php declare(strict_types=1);

namespace App\Controller;

use App\DTO\FamilyTreeData;
use App\Exception\FamilyTreeException;
use App\Service\FamilyTree;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class FamilyTreeController extends AbstractController
{
    /**
     * @Route("/family-tree", methods={"POST"})
     */
    public function create(FamilyTreeData $data, FamilyTree\Creating $creating, FamilyTree\Read $read): Response
    {
        try {
            $uuid = $creating->handle($data);
            return $this->json($read->one($uuid)->data(), Response::HTTP_CREATED);
        } catch (FamilyTreeException $e) {
            return $this->json($e->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (EntityNotFoundException $e) {
            return $this->json($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
