<?php

declare(strict_types=1);

namespace App\VendingMachine\Model\Action;

class ActionsLookup
{
    public const SHOW_PRODUCTS = 'show_products';

    public const SHOW_PRODUCT = 'show_product';

    public const ADD_PRODUCT = 'add_product';

    public const ACTION_DESCRIPTION_MAP = [
        self::SHOW_PRODUCTS => 'Show all products',
        self::SHOW_PRODUCT => 'Show product',
        self::ADD_PRODUCT => 'Show product',
    ];
}
