<?php
declare(strict_types=1);

namespace App\VendingMachine\Entity;

class Product
{
    private int|null $id;

    private string $code;

    private string $name;

    private float $price;

    /**
     * @param string $code
     * @param string $name
     * @param float $price
     */
    public function __construct(
        string $code,
        string $name,
        float $price
    ) {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }
}
