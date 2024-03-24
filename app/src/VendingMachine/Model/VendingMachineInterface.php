<?php

namespace App\VendingMachine\Model;

interface VendingMachineInterface
{
    /**
     * @return void
     */
    public function showProducts(): void;

    /**
     * @return void
     */
    public function showProduct(): void;

    /**
     * @return void
     */
    public function addProduct(): void;
}
