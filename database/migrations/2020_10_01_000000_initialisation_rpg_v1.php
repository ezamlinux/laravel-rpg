<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialisationRpgV1 extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        $this->upPlayers();
        $this->upMonsters();
        $this->upInventories();
        $this->upItems();
        $this->upTitles();
        $this->upLocations();
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->downPlayers();
        $this->downMonsters();
        $this->downInventories();
        $this->downItems();
        $this->downTitles();
        $this->downLocations();
    }

    /**
     * ************************************
     * *********** UP MIGRATIONS **********
     * ************************************
     */

    public function upPlayers()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable()->index();
            $table->string('discord_id');
            $table->integer('title_id')->default('1')->index();
            $table->integer('location_id')->default('1')->index();
            $table->string('name');
            $table->text('biography')->nullable();
            $table->integer('experience')->default('0');
            $table->integer('level')->default('1');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function upMonsters()
    {
        Schema::create('monsters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('experience');
            $table->integer('monster_type_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('monster_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('location_monster', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('monster_id');
            $table->integer('location_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('monster_id');
            $table->integer('player_id');
            $table->string('name');
            $table->integer('level')->default('1');
            $table->integer('experience');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function upInventories()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('inventorable_type')->index();
            $table->integer('inventorable_id')->index();
            $table->integer('inventory_type_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inventory_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('item_id')->index();
            $table->integer('inventory_id')->index();
            $table->integer('quantity')->default('1');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inventory_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('capacity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function upItems()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('price');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('recipes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('result_id');
            $table->integer('quantity')->default('1');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('recipe_id');
            $table->integer('item_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function upTitles()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function upLocations()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('location_type_id')->index();
            $table->integer('parent_id')->nullable()->index();
            $table->integer('minimal_level');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('location_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * ************************************
     * ********** DOWN MIGRATIONS *********
     * ************************************
     */

    public function downPlayers()
    {
        Schema::dropIfExists('players');
    }

    public function downMonsters()
    {
        Schema::dropIfExists('monsters');
        Schema::dropIfExists('monster_types');
        Schema::dropIfExists('location_monster');
        Schema::dropIfExists('pets');
    }

    public function downInventories()
    {
        Schema::dropIfExists('inventories');
        Schema::dropIfExists('inventory_item');
        Schema::dropIfExists('inventory_types');
    }

    public function downItems()
    {
        Schema::dropIfExists('items');
        Schema::dropIfExists('recipes');
        Schema::dropIfExists('ingredients');
    }

    public function downTitles()
    {
        Schema::dropIfExists('titles');
    }

    public function downLocations()
    {
        Schema::dropIfExists('locations');
        Schema::dropIfExists('location_types');
    }
}

