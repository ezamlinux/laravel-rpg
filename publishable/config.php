<?php

return [
    /**
     * configuration
     */
    'http' => [
        /**
         * display basic administration interface
         */
        'back-office' => [
            'enabled' => true,
            'prefix' => 'rpg', // https://mywebsite.com/$prefix
            'middleware' => [
                'web'
            ]
        ],
        'namespace' => 'Rpg\\Http\\Controllers',
    ],

    // aliases
    'aliases' => [
      'Rpg' => Rpg\Facades\Rpg::class
    ],

    /**
     * Overwrite your class here
     */
    'models' => [
        'User'          => App\User::class,

        // RPG
        'Player'        => Rpg\Models\Player::class,
        'Monster'       => Rpg\Models\Monster::class,
        'MonsterType'   => Rpg\Models\MonsterType::class,
        'Item'          => Rpg\Models\Item::class,
        'Ingredient'    => Rpg\Models\Ingredient::class,
        'Title'         => Rpg\Models\Title::class,
        'Location'      => Rpg\Models\Location::class,
        'LocationType'  => Rpg\Models\LocationType::class,
        'Pet'           => Rpg\Models\Pet::class,
        'Recipe'        => Rpg\Models\Recipe::class,
        'Inventory'     => Rpg\Models\Inventory::class,
        'InventoryType' => Rpg\Models\InventoryType::class,
    ],

    /**
     * define MorphMap
     */
    'morphMaps' => [
        'Player'  => Rpg\Models\Player::class,
        'Monster' => Rpg\Models\Monster::class
    ]
];
