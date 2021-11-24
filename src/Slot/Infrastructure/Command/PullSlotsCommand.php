<?php

declare(strict_types=1);

namespace App\Slot\Infrastructure\Command;

use App\Slot\Application\PullSlotsRequest;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use App\Slot\Application\Service\PullSlotsService;

final class PullSlotsCommand extends Command
{
    private PullSlotsRequest $request;
    private PullSlotsService $service;

    public function __construct(PullSlotsRequest $request, PullSlotsService $service)
    {
        $this->request = $request;
        $this->service = $service;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->service->execute($this->request);
        } catch (\Exception) {
            echo "FAIL! Slots not pulled\n";
            return Command::FAILURE;
        }

        echo "SUCCESS! Slots pulled successfully\n";
        return Command::SUCCESS;
    }
}
