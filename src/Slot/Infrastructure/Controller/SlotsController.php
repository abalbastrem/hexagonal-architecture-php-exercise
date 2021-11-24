<?php

declare(strict_types=1);

namespace App\Slot\Infrastructure\Controller;

use App\Slot\Application\ListSlotsRequest;
use App\Slot\Application\PullSlotsRequest;
use App\Slot\Application\Service\ListSlotsService;
use App\Slot\Domain\Exception\DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\Exception\InvalidArgumentException;
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
        try {
            if (empty($request->get('sort_type'))) {
                throw new InvalidArgumentException();
            }
            $listSlotsRequest = new ListSlotsRequest(
                strval($request->get('sort_type')),
                new \DateTime($request->get('date_from')),
                new \DateTime($request->get('date_to'))
            );
        } catch (\Exception) {
            $e = new InvalidArgumentException('wrong params. Expected sort_type (string), date_from (yyyymmdd), date_to (yyyymmdd)',
                400);
            return new Response(json_encode(array(
                'error' => array(
                    'msg' => "Error: " . $e->getMessage(),
                    'code' => $e->getCode()
                )
            )), $e->getCode());
        }

        try {
            $slotSortedCollection = $service->list($listSlotsRequest);
        } catch (DomainException $e) {
            return new Response(json_encode(array(
                'error' => array(
                    'msg' => "Error: " . $e->getMessage(),
                    'code' => $e->getCode()
                )
            )), 400);
        }

        return new Response(json_encode($slotSortedCollection->flatten()));
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

        return new Response("OK slots pulled successfully", 200);
    }
}
