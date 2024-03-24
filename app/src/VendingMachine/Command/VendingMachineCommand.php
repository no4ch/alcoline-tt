<?php
declare(strict_types=1);

namespace App\VendingMachine\Command;

use App\VendingMachine\Exception\Action\ActionNotSupportedException;
use App\VendingMachine\Model\Action\ActionsLookup;
use App\VendingMachine\Model\ConsoleVendingMachine;
use App\VendingMachine\Model\Renderer\ConsoleProductRenderer;
use App\VendingMachine\Model\VendingMachineInterface;
use App\VendingMachine\Repository\MockProductRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'vending-machine-cli',
    description: 'CLI command for running vending machine'
)]
class VendingMachineCommand extends Command
{
    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $vendingMachine = $this->createVendingMachine($io);

        $io->title('Vending machine');

        while (true) {
            $io->writeln('Choose action below. For exit press ctrl+c.');

            $this->showActions($io);

            try {
                $action = (string) $this->readAction($io);

                // can be replaced via polymorphism
                switch ($action) {
                    case ActionsLookup::SHOW_PRODUCTS:
                        $vendingMachine->showProducts();
                        break;
                    case ActionsLookup::SHOW_PRODUCT:
                        $vendingMachine->showProduct();
                        break;
                    case ActionsLookup::ADD_PRODUCT:
                        $vendingMachine->addProduct();
                        break;
                    default:
                        throw new ActionNotSupportedException(sprintf(
                            'Action "%s" not supported', $action
                        ));
                }
            } catch (ActionNotSupportedException $e) {
                $io->warning($e->getMessage());

                continue;
            }
        }

        return self::SUCCESS;
    }

    /**
     * @param SymfonyStyle $io
     * @return VendingMachineInterface
     */
    private function createVendingMachine(SymfonyStyle $io): VendingMachineInterface
    {
        $productRepository = new MockProductRepository();

        return new ConsoleVendingMachine(
            new ConsoleProductRenderer($io),
            $productRepository,
            $io
        );
    }

    /**
     * @param SymfonyStyle $io
     * @return void
     */
    private function showActions(SymfonyStyle $io): void
    {
        $table = new Table($io);

        $table->setHeaders([
            'Action',
            'Description'
        ]);

        foreach (ActionsLookup::ACTION_DESCRIPTION_MAP as $actionKey => $action) {
            $table->addRow([
                $actionKey,
                $action
            ]);
        }

        $table->render();
    }

    /**
     * @param SymfonyStyle $io
     * @return string
     */
    private function readAction(SymfonyStyle $io): string
    {
        return (string) $io->ask('Enter action');
    }
}
