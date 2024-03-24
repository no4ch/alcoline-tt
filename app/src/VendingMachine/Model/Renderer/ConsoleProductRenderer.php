<?php

declare(strict_types=1);

namespace App\VendingMachine\Model\Renderer;

use App\VendingMachine\Entity\Product;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Style\SymfonyStyle;

class ConsoleProductRenderer implements ProductRendererInterface
{
    private SymfonyStyle $io;

    /**
     * @param SymfonyStyle $io
     */
    public function __construct(
        SymfonyStyle $io
    ) {
        $this->io = $io;
    }

    /**
     * @param Product[] $products
     * @return void
     */
    public function showProducts(array $products): void
    {
        $this->renderProductsTable($products);
    }

    /**
     * @param Product[] $products
     * @return void
     */
    private function renderProductsTable(array $products): void
    {
        $table = new Table($this->io);

        $table
            ->setHeaders([
                'Code',
                'Name',
                'Price',
            ]);

        foreach ($products as $product) {
            $table->addRow([
                $product->getCode(),
                $product->getName(),
                $product->getPrice(),
            ]);
        }

        $table->render();

        $this->io->newLine();
    }
}
