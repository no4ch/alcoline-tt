<?php
declare(strict_types=1);

namespace App\VendingMachine\Model;

use App\VendingMachine\Model\Renderer\ProductRendererInterface;
use App\VendingMachine\Repository\ProductRepositoryInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

// actions can be replaced via delegation to some action handler in future
class ConsoleVendingMachine implements VendingMachineInterface
{
    private ProductRendererInterface $productRenderer;

    private ProductRepositoryInterface $productRepository;

    private SymfonyStyle $io;

    public function __construct(
        ProductRendererInterface $productRenderer,
        ProductRepositoryInterface $productRepository,
        SymfonyStyle $io
    ) {
        $this->productRenderer = $productRenderer;
        $this->productRepository = $productRepository;
        $this->io = $io;
    }

    /**
     * @return void
     */
    public function showProducts(): void
    {
        // temporary doesn`t supports input count and offset
        $products = $this->productRepository->getProducts(100, 0);

        $this->productRenderer->showProducts($products);
    }

    /**
     * @return void
     */
    public function showProduct(): void
    {
        $productCode = (string) $this->io->ask('Enter product code');

        $products = [];
        if ($product = $this->productRepository->getProduct($productCode)) {
            $products[] = $product;
        }

        $this->productRenderer->showProducts($products);
    }

    /**
     * @return void
     */
    public function addProduct(): void
    {
        $code = (string) $this->io->ask('Write product code.');

        $name = (string) $this->io->ask('Write product name.');

        $price = (float) $this->io->ask('Write product price.');

        $product = $this->productRepository->create($code, $name, $price);

        $this->productRepository->saveProduct($product);

        $this->io->writeln('Product was added. Added product info:');

        $this->productRenderer->showProducts([$product]);
    }
}
