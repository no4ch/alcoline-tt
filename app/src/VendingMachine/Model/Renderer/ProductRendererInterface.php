<?php

namespace App\VendingMachine\Model\Renderer;

use App\VendingMachine\Entity\Product;

interface ProductRendererInterface
{
    /**
     * @param Product[] $products
     * @return void
     */
    public function showProducts(array $products): void;
}
