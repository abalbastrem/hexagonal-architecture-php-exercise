<?php
declare(strict_types=1);

namespace App\Slot\Infraestructure\Controller;

use App\Slot\Application\ListSlotsRequest;
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

    }
}
