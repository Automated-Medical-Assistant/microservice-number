<?php

declare(strict_types=1);

namespace App\Communication\Console;


use App\Communication\CommunicationFacadeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DispatchNumberListCommand extends Command
{
    public const COMMAND_NAME = 'nxs:sendNumberList';
    /**
     * @var \App\Communication\CommunicationFacadeInterface
     */
    private CommunicationFacadeInterface $communicationFacade;

    public function __construct(string $name = null, CommunicationFacadeInterface $communicationFacade)
    {
        parent::__construct($name);
        $this->communicationFacade = $communicationFacade;
    }

    protected function configure(): void
    {
        $this->setName(self::COMMAND_NAME)
            ->setDescription('Populate the NumberList on the Event');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->writeln('Start the population to dispatch');
        $this->communicationFacade->sendNumberListRequest();
        $io->success('All Populated');
        return 0;
    }
}
