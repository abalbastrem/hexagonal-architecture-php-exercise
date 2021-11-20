<?php
declare(strict_types=1);

namespace App\Slot\Infraestructure\Controller;

use App\Slot\Application\FetchSlotsRequest;
use App\Slot\Application\ListSlotsRequest;
use App\Slot\Domain\Entity\SlotsCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SlotsController extends AbstractController
{
    /**
     * @Route("/slots", name="slots")
     */
    public function list(ListSlotsRequest $request): Response
    {
        // TODO: implement this (you can change the signature)

        return new Response("list SUCCESS", 200);
    }

    /**
     * @Route("/fetch", name="fetch")
     */
    public function fetch(FetchSlotsRequest $request): Response
    {
        try {
            $request->fetchAll();
        } catch (\Exception $e) {
            return new Response($e->getMessage(), $e->getCode());
        }

        return new Response("fetch SUCCESS", 200);
    }
}
