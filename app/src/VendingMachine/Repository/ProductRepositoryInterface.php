<?php

namespace App\VendingMachine\Repository;

use App\VendingMachine\Entity\Product;

interface ProductRepositoryInterface
{
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
    ): Product;

    /**
     * @param int $count
     * @param int $offset
     * @return Product[]
     */
    public function getProducts(int $count, int $offset): array;

    /**
     * @param string $code
     * @return Product|null
     */
    public function getProduct(string $code): ?Product;

    /**
     * @param Product $product
     * @return void
     */
    public function saveProduct(Product $product): void;
}
