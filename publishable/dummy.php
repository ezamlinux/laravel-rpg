<?php

return [
    'data' => [
        /***
         * PLAYERS
         */
        'firstPlayer' => [
            'name' => 'eZam',
            'discord_id' => '408297934128414731',
            'title_id' => 1,
            'level' => 1,
            'experience' => 0
        ],

        'titles' => [
            ['name' => 'Ranger'],
            ['name' => 'Rogue'],
            ['name' => 'Cleric'],
            ['name' => 'Wizard'],
            ['name' => 'Knight'],
            ['name' => 'Bard'],
            ['name' => 'Paladin']
        ],

        /**
         * LOCATIONS
         **/
        'locations' => [
            [
                'name' => 'Kantho',
                'minimal_level' => 0,
                'location_type_id' => 2
            ],
            [
                'name' => 'Hoenn',
                'minimal_level' => 5,
                'location_type_id' => 2
            ]
        ],

        'locationTypes' => [
            [
                'name' => 'City',
            ],
            [
                'name' => 'Region',
            ],
            [
                'name' => 'Land',
            ]
        ],

        /**
         * MONSTERS
         */
        'monsterTypes' => [
            [
                'name' => 'small',
            ],
            [
                'name' => 'medium',
            ],
            [
                'name' => 'big',
            ],
            [
                'name' => 'titan'
            ]
        ],

        'monsters' => [
            [
                'name' => 'Wolf',
                'experience' => 5,
                'monster_type_id' => 2
            ],
            [
                'name' => 'Slime',
                'experience' => 3,
                'monster_type_id' => 1
            ],
            [
                'name' => 'Goblin',
                'experience' => 5,
                'monster_type_id' => 2
            ],
            [
                'name' => 'Troll',
                'experience' => 10,
                'monster_type_id' => 1
            ],
            [
                'name'  => 'Hydra',
                'experience' => 20,
                'monster_type_id' => 4
            ]
        ],

        'first_pets' => [
            'name' => 'Kanigou',
            'experience' => 0,
            'monster_id' => 2,
        ],

        /**
         * ITEMS
         */

        'items' => [
            // Equipement
            [
                'name' => 'Training Sword',
                'price' => 50,
            ],
            [
                'name' => 'Wooden Sword',
                'price' => 5,
            ],
            [
                'name' => 'Wooden Armor',
                'price' => 5,
            ],
            [
                'name' => 'Fish Sword',
                'price' => 10,
            ],
            // Items
            [
                'name' => 'Rope',
                'price' => 1,
            ],
            [
                'name' => 'wood',
                'price' => 1,
            ],
            // Food
            [
                'name' => 'egg',
                'price' => 1
            ],
            [
                'name' => 'raw meat',
                'price' => 5
            ],
            [
                'name' => 'salt',
                'price' => 1
            ],
            // Cooking
            [
                'name' => 'cooked meat',
                'price' => 10
            ],
            [
                'name' => 'Bacon and Eggs',
                'price' => 12
            ]
        ],

        'recipes' => [
            [
                'name' => 'Training sword',
                'result_id' => 1,
                'quantity' => 1
            ],
            [
                'name' => 'Training sword alternate',
                'result_id' => 1,
                'quantity' => 1
            ],
            [
                'name' => 'Wooden sword',
                'result_id' => 2,
                'quantity' => 1
            ],
            [
                'name' => 'Cooked meat',
                'result_id' => 10,
                'quantity' => 1
            ],
            [
                'name' => 'Bacon and Eggs',
                'result_id' => 11,
                'quantity' => 1
            ]
        ],

        'ingredients' => [
            // Training sword
            [
                'recipe_id' => 1,
                'item_id' => 2,
                'quantity' => 1
            ],
            [
                'recipe_id' => 1,
                'item_id' => 5,
                'quantity' => 2
            ],
            // Training sword alternate
            [
                'recipe_id' => 2,
                'item_id' => 2,
                'quantity' => 2
            ],
            [
                'recipe_id' => 2,
                'item_id' => 5,
                'quantity' => 1
            ],
            // Wooden sword
            [
                'recipe_id' => 3,
                'item_id' => 6,
                'quantity' => 2
            ],
            // 4 Cooked meat
            [
                'recipe_id' => 4,
                'item_id' => 8,
                'quantity' => 1
            ],
            // 5 bacons and eggs
            [
                'recipe_id' => 5,
                'item_id' => 8,
                'quantity' => 1
            ],
            [
                'recipe_id' => 5,
                'item_id' => 7,
                'quantity' => 2
            ]
        ],

        'inventoryTypes' => [
            [
                'name' => 'loot_table',
                'capacity' => 0
            ],
            [
                'name' => 'Satchel',
                'capacity' => 10
            ],
            [
                'name' => 'Duffel Bag',
                'capacity' => 25
            ],
            [
                'name' => 'Backpack',
                'capacity' => 50
            ]
        ]
    ]
];
