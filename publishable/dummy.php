<?php

return [
    'data' => [
        // unused for now
        'firstPlayer' => [
            'name' => 'eZam',
            'discord_id' => '408297934128414731',
            'title' => [
                'name' => 'Ranger'
            ],
            'level' => 1,
            'experience' => 0,
            'pets' => [
                'name' => 'Kanigou',
                'experience' => 0,
                'monster' => [
                    'name' => 'Wolf'
                ],
            ],
        ],

        /***
         * PLAYERS
         */
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
                'name' => 'Kanto',
                'location_type' => [
                    'name' => 'Region'
                ]
            ],
            [
                'name' => 'Hoenn',
                'minimal_level' => 5,
                'location_type' => [
                    'name' => 'Region'
                ]
            ],
            [
                'name' => 'Céladopole',
                'minimal_level' => 5,
                'location_type' => [
                    'name' => 'City'
                ],
                'parent' => [
                    'name' => 'Kanto'
                ]
            ],
            [
                'name' => 'Lavanville',
                'location_type' => [
                    'name' => 'City'
                ],
                'parent' => [
                    'name' => 'Kanto'
                ]
            ],
            [
                'name' => 'Lavandia',
                'location_type' => [
                    'name' => 'City'
                ],
                'parent' => [
                    'name' => 'Hoenn'
                ]
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
                'monster_type' => [
                    'name' => 'small'
                ]
            ],
            [
                'name' => 'Slime',
                'experience' => 3,
                'monster_type' => [
                    'name' => 'small'
                ]
            ],
            [
                'name' => 'Goblin',
                'experience' => 5,
                'monster_type' => [
                    'name' => 'medium'
                ]
            ],
            [
                'name' => 'Troll',
                'experience' => 10,
                'monster_type' => [
                    'name' => 'big'
                ]
            ],
            [
                'name'  => 'Hydra',
                'experience' => 20,
                'monster_type' => [
                    'name' => 'titan'
                ]
            ]
        ],

        /**
         * ITEMS
         */
        'items' => [
            // Equipement
            [
                'name' => 'Training Sword',
                'price' => 50,
                'recipes' => [
                    [
                        'name' => 'Training sword',
                        'quantity' => 1,
                        'ingredients' => [
                            [
                                'item' => [
                                    'name' => 'Wooden Sword'
                                ],
                                'quantity' => 1
                            ],
                            [
                                'item' => [
                                    'name' => 'Rope'
                                ],
                                'quantity' => 2
                            ],
                        ]
                    ],
                    [
                        'name' => 'Training sword alternate',
                        'quantity' => 1,
                        'ingredients' => [
                            [
                                'item' => [
                                    'name' => 'Wooden Sword'
                                ],
                                'quantity' => 2
                            ],
                            [
                                'item' => [
                                    'name' => 'Rope'
                                ],
                                'quantity' => 1
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Wooden Sword',
                'price' => 5,
                'recipes' => [
                    [
                        'name' => 'Wooden Sword',
                        'quantity' => 1,
                        'ingredients' => [
                            [
                                'item' => [
                                    'name' => 'Wood'
                                ],
                                'quantity' => 2
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Wooden Armor',
                'price' => 5,
            ],
            // Items
            [
                'name' => 'Rope',
                'price' => 1,
            ],
            [
                'name' => 'Wood',
                'price' => 1,
            ],
            // Food
            [
                'name' => 'Egg',
                'price' => 1
            ],
            [
                'name' => 'Raw Meat',
                'price' => 5
            ],
            [
                'name' => 'Salt',
                'price' => 1
            ],
            // Cooking
            [
                'name' => 'cooked meat',
                'price' => 10,
                'recipes' => [
                    [
                        'name' => 'Cooked meat',
                        'quantity' => 1,
                        'ingredients' => [
                            [
                                'item' => [
                                    'name' => 'Raw Meat'
                                ],
                                'quantity' => 1
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Bacon and Eggs',
                'price' => 12,
                'recipes' => [
                    [
                        'name' => 'Bacon and Eggs',
                        'quantity' => 1,
                        'ingredients' => [
                            [
                                'item' => [
                                    'name' => 'Raw Meat'
                                ],
                                'quantity' => 1
                            ],
                            [
                                'item' => [
                                    'name' => 'Egg'
                                ],
                                'quantity' => 2
                            ]
                        ]
                    ]
                ],
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
