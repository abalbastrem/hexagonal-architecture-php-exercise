<?php
declare(strict_types=1);

namespace App\Slot\Infrastructure\Controller;

use App\Slot\Application\ListSlotsRequest;
use App\Slot\Application\PullSlotsRequest;
use App\Slot\Application\Service\ListSlotsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Slot\Application\Service\PullSlotsService;

// TODO inject specific requests
final class SlotsController extends AbstractController
{
    /**
     * @Route("/slots", name="slots")
     */
    public function list(Request $request, ListSlotsService $service): Response
    {
        $listSlotsRequest = new ListSlotsRequest(
            strval($request->get('sort_type', 0)),
            new \DateTime($request->get('date_from', 'now')),
            new \DateTime($request->get('date_to', 'now')),
//            $request->get('doctor_id')
        );
        echo "<pre>";
        $slotSortedCollection = $service->list($listSlotsRequest);

        return new Response(print_r($slotSortedCollection, true), 200);
    }

    /**
     * @Route("/pull", name="pull")
     */
    public function pull(PullSlotsRequest $request, PullSlotsService $service): Response
    {
        try {
            $service->pull($request);
        } catch (\Exception $e) {
            return new Response($e->getMessage(), $e->getCode());
        }

        return new Response("OK slots pulled", 200);
    }
}
