<?php

declare(strict_types=1);

namespace App\VendingMachine\Repository;

use App\VendingMachine\Entity\Product;

class MockProductRepository implements ProductRepositoryInterface
{
    private array $products = [];

    /**
     * @param string $code
     * @param string $name
     * @param float $price
     * @return Product
     */
    public function create(
        string $code,
        string $name,
        float $price
    ): Product {
        return new Product(
            $code,
            $name,
            $price
        );
    }

    /**
     * @return Product[]
     */
    public function getProducts(int $count, int $offset): array
    {
        $this->initProducts();

        return array_slice($this->products, $offset, $count);
    }

    /**
     * @param string $code
     * @return Product|null
     */
    public function getProduct(string $code): ?Product
    {
        $this->initProducts();

        $products = array_filter($this->products, static function (Product $product) use ($code) {
            return $product->getCode() === $code;
        });

        $product = null;

        if ($products) {
            $product = end($products);
        }

        return $product;
    }

    /**
     * @param Product $product
     * @return void
     */
    public function saveProduct(Product $product): void
    {
        $this->initProducts();

        $this->products[] = $product;
    }

    /**
     * @return void
     */
    private function initProducts(): void
    {
        if (!$this->products) {
            $this->products = $this->createBaseProducts();
        }
    }

    /**
     * @return Product[]
     */
    private function createBaseProducts(): array
    {
        return [
            $this->create('coca-cola', 'Coca cola', 1.50),
            $this->create('snickers', 'Snickers', 1.20),
            $this->create('lays', 'Lay`s', 2.00),
        ];
    }
}
