<?php

declare(strict_types=1);

namespace App\Slot\Infrastructure\Controller;

use App\Slot\Application\PullSlotsRequest;
use App\Slot\Application\Service\PullSlotsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SlotsController extends AbstractController
{
    /**
     * Backup pull method if Command doesn't work
     * @Route("/pull", name="pull")
     */
//    public function pull(PullSlotsRequest $request, PullSlotsService $service): Response
//    {
//        try {
//            $service->execute($request);
//        } catch (\Exception $e) {
//            return new Response($e->getMessage(), $e->getCode());
//        }
//
//        return new Response("OK slots pulled successfully", 200);
//    }
}
