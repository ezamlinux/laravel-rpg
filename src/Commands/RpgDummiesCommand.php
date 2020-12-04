<?php

namespace Rpg\Commands;

use Illuminate\Console\Command;
use Rpg;

class RpgDummiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rpg:inject {--config=rpg_dummy} {--fresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert dummy data from config file';

    public $Player;
    public $Title;
    public $Monster;
    public $Location;
    public $Item;
    public $Recipe;
    public $Inventory;
    public $InventoryType;
    public $Ingredient;

    public function __construct()
    {
        parent::__construct();

        $this->Player        = app(Rpg::class('Player'));
        $this->Title         = app(Rpg::class('Title'));
        $this->Monster       = app(Rpg::class('Monster'));
        $this->MonsterType   = app(Rpg::class('MonsterType'));
        $this->Location      = app(Rpg::class('Location'));
        $this->LocationType  = app(Rpg::class('LocationType'));
        $this->Item          = app(Rpg::class('Item'));
        $this->Recipe        = app(Rpg::class('Recipe'));
        $this->Inventory     = app(Rpg::class('Inventory'));
        $this->InventoryType = app(Rpg::class('InventoryType'));
        $this->Ingredient    = app(Rpg::class('Ingredient'));
    }

    /**
     * Execute the console command.
     *
     * @param  \App\DripEmailer  $drip
     * @return mixed
     */
    public function handle()
    {
        if (! config($this->option('config'))) {
            return false;
        }

        $startTime = microtime(TRUE);

        $this->source = config($this->option('config'));

        $this->timestamps = [
            'created_at' => now(),
            'updated_at' => now(),
        ];

        /***
         * PLAYERS
         */
        $this->titles = $this->source['data']['titles'];

        /**
         * LOCATIONS
         **/
        $this->locations = $this->source['data']['locations'];
        $this->locationTypes = $this->source['data']['locationTypes'];

        /**
         * MONSTERS
         */
        $this->monsterTypes = $this->source['data']['monsterTypes'];
        $this->monsters = $this->source['data']['monsters'];

        /**
         * ITEMS
         */
        $this->items = $this->source['data']['items'];
        $this->inventoryTypes = $this->source['data']['inventoryTypes'];

        if ($this->option('fresh'))
        {
            $this->call('migrate:fresh');
        }

        $this->dummyInventory();
        $this->dummyTitles();
        $this->dummyLocations();
        $this->dummyMonsters();
        $this->dummyItems();

        $runTime = number_format((microtime(true) - $startTime) * 1000, 2);

        $this->line('<info>Seeding done.</info> ('.$runTime.'ms)');
    }

    protected function dummyTitles()
    {
        $this->info('Feeding Titles ...');

        $this->Title->insert(array_map(fn ($x) => array_merge($x, $this->timestamps), $this->titles));
    }

    protected function dummyLocations()
    {
        $this->info('Feeding Locations ...');

        $this->LocationType->insert(array_map(fn ($x) => array_merge($x, $this->timestamps), $this->locationTypes));

        foreach ($this->locations as $dummy_location)
        {
            $this->Location->firstOrCreate(
                ['name' => $dummy_location['name']],
                array_merge(
                    [
                        'minimal_level' => $dummy_location['minimal_level'] ?? null,
                        'location_type_id' => $this->LocationType->where('name', $dummy_location['location_type']['name'])->value('id'),
                        'parent_id' => $this->Location->where('name', $dummy_location['parent']['name'] ?? null)->value('id'),
                    ], $this->timestamps
                )
            );
        }
    }

    public function dummyMonsters()
    {
        $this->info('Feeding Monsters ...');

        $this->Monster->monster_type()->insert(array_map(fn ($x) => array_merge($x, $this->timestamps), $this->monsterTypes));

        foreach ($this->monsters as $monster) {
            $this->Monster->firstOrCreate(
                ['name' => $monster['name']],
                array_merge(
                    [
                        'experience' => $monster['experience'],
                        'monster_type_id' => $this->MonsterType->where('name', $monster['monster_type']['name'])->value('id')
                    ], $this->timestamps
                )
            );
        }
    }

    protected function dummyItems()
    {
        $this->info('Feeding Items ...');

        foreach ($this->items as $item)
        {
            $model = $this->Item->firstOrCreate(
                ['name' => $item['name']],
                ['price' => $item['price'],['description' => $item['description'] ?? null]]
            );
        }

        // second loop for recipes and ingredients
        foreach ($this->items as $item)
        {
            if (array_key_exists('recipes', $item)) {
                foreach ($item['recipes'] as $dummy_recipe) {
                    $recipe = $model->recipes()->firstOrCreate(
                        ['name' => $dummy_recipe['name'], 'result_id' => $this->Item->where('name', $item['name'])->value('id')],
                        array_merge(['quantity' => $dummy_recipe['quantity']], $this->timestamps)
                    );

                    foreach ($dummy_recipe['ingredients'] as $ingredient) {
                        $this->Ingredient->firstOrCreate(
                            [
                                'recipe_id' => $recipe->id,
                                'item_id' => $this->Item->where('name', $ingredient['item']['name'])->value('id'),
                                'quantity' => $ingredient['quantity']
                            ],
                            $this->timestamps
                        );
                    }
                }
            }
        }
    }

    protected function dummyInventory()
    {
        $this->info('Feeding Inventory ...');

        $this->Inventory->inventory_type()->insert(array_map(fn ($x) => array_merge($x, $this->timestamps), $this->inventoryTypes));
    }
}

