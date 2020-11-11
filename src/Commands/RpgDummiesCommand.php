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
        $this->Location      = app(Rpg::class('Location'));
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

        $this->source = config($this->option('config'));

        /***
         * PLAYERS
         */
        $this->firstPlayer = $this->source['data']['firstPlayer'];
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
        $this->first_pets = $this->source['data']['first_pets'];

        /**
         * ITEMS
         */
        $this->items = $this->source['data']['items'];
        $this->recipes = $this->source['data']['recipes'];
        $this->ingredients = $this->source['data']['ingredients'];
        $this->inventoryTypes = $this->source['data']['inventoryTypes'];

        if ($this->option('fresh'))
        {
            $this->call('migrate:fresh');
        }

        $this->dummyInventory();
        $this->dummyPlayers();
        $this->dummyLocations();
        $this->dummyMonsters();
        $this->dummyItems();
        $this->links();
    }

    protected function dummyPlayers()
    {
        $this->info('Feeding Players ...');

        $this->Player->firstOrCreate($this->firstPlayer);
        $this->Title->insert($this->titles);
    }

    protected function dummyLocations()
    {
        $this->info('Feeding Locations ...');
        $this->Location->location_type()->insert($this->locationTypes);
        $this->Location->insert($this->locations);
    }

    public function dummyMonsters()
    {
        $this->info('Feeding Monsters ...');

        $this->Monster->monster_type()->insert($this->monsterTypes);
        $this->Monster->insert($this->monsters);
    }

    protected function dummyItems()
    {
        $this->info('Feeding Items ...');

        $this->Item->insert($this->items);
        $this->Recipe->insert($this->recipes);
        $this->Ingredient->insert($this->ingredients);
    }

    protected function dummyInventory()
    {
        $this->info('Feeding Inventory ...');
        $this->Inventory->inventory_type()->insert($this->inventoryTypes);
    }

    protected function links()
    {
        $this->info('Making some magical attachment ...');

        // create first Player pet
        $this->Player
            ->find(1)
            ->pets()
            ->create($this->first_pets);

        // Attach monsters to locations;
        $locations = $this->Location->all();
        $monsters = $this->Monster->all()->shuffle()->split($locations->count());

        $locations->each(fn ($item, $key) => $item->monsters()->sync($monsters[$key]));

        // Create Loot Table for Monster
        $this->Monster
            ->all()
            ->each(function ($monster) {
                $monster
                    ->inventories()
                    ->create([
                        'name' => ($monster->name . ' Loot Table'),
                        'inventory_type_id' => $this->InventoryType->where('name', 'loot_table')->value('id')
                    ]);
                // attach One random Item
                $monster
                    ->inventories()
                    ->first()
                    ->items()->sync($this->Item->get()->random(1));
            });

        // Create Bag for user
        $this->Player
            ->find(1)
            ->inventories()
            ->create([
                'name' => 'Player Inventory',
                'inventory_type_id' => $this->InventoryType->where('name', 'Duffel Bag')->value('id')
            ]);

        // Attach ingredient for Training Sword Recipe
        $this->Player
            ->find(1)
            ->inventories->first()
            ->items()
            ->attach($this->Recipe->with('ingredients.item')->where('name', 'Training sword')->first()->ingredients->pluck('item.id'));
    }
}

