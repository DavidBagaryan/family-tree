<?php declare(strict_types=1);

namespace App\Controller;

use App\DTO\FamilyTreeData;
use App\Service\Read;
use App\Service\Write;
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
    public function create(FamilyTreeData $data, Write $write, Read $read): Response
    {
        $ft = $write->one($data);
        return $this->json($read->one( $ft->uuid())->data(), Response::HTTP_CREATED);
    }
}
