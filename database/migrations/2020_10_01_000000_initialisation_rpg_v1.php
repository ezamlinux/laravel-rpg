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
        $this->upTitles();
        $this->upLocations();
        $this->upPlayers();
        $this->upMonsters();
        $this->upItems();
        $this->upInventories();
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $this->downPlayers();
        $this->downMonsters();
        $this->downItems();
        $this->downInventories();
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
            $table->foreignId('user_id')->nullable()->index();
            $table->string('discord_id');
            $table->foreignId('title_id')->index();
            $table->foreignId('location_id')->index();
            $table->string('name');
            $table->text('biography')->nullable();
            $table->integer('experience')->default('0');
            $table->integer('level')->default('1');
            $table->timestamps();
            $table->softDeletes();
        });

        // FOREIGN KEY

        Schema::table('players', function($table) {
            $table->foreign('title_id')->references('id')->on('titles');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    public function upMonsters()
    {
        Schema::create('monster_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('monsters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('experience');
            $table->foreignId('monster_type_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('location_monster', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('monster_id');
            $table->foreignId('location_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('monster_id');
            $table->foreignId('player_id');
            $table->string('name');
            $table->integer('level')->default('1');
            $table->integer('experience');
            $table->timestamps();
            $table->softDeletes();
        });

        // FOREIGN KEY

        Schema::table('monsters', function($table) {
            $table->foreign('monster_type_id')->references('id')->on('monster_types');
        });

        Schema::table('location_monster', function($table) {
            $table->foreign('monster_id')->references('id')->on('monsters');
            $table->foreign('location_id')->references('id')->on('locations');
        });

        Schema::table('pets', function($table) {
            $table->foreign('monster_id')->references('id')->on('monsters');
            $table->foreign('player_id')->references('id')->on('players');
        });
    }

    public function upInventories()
    {
        Schema::create('inventory_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('capacity');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->morphs('inventorable');
            $table->foreignId('inventory_type_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inventory_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('item_id')->index();
            $table->foreignId('inventory_id')->index();
            $table->integer('quantity')->default('1');
            $table->timestamps();
            $table->softDeletes();
        });

        // FOREIGN KEY

        Schema::table('inventories', function($table) {
            $table->foreign('inventory_type_id')->references('id')->on('inventory_types');
        });

        Schema::table('inventory_item', function($table) {
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('inventory_id')->references('id')->on('inventories');
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
            $table->foreignId('result_id');
            $table->integer('quantity')->default('1');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ingredients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('recipe_id');
            $table->foreignId('item_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
        });

        // FOREIGN KEY

        Schema::table('recipes', function($table) {
            $table->foreign('result_id')->references('id')->on('items');
        });

        Schema::table('ingredients', function($table) {
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('recipe_id')->references('id')->on('recipes');
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
        Schema::create('location_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->foreignId('location_type_id')->index();
            $table->integer('parent_id')->nullable()->index();
            $table->integer('minimal_level')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // FOREIGN KEY

        Schema::table('locations', function($table) {
            $table->foreign('location_type_id')->references('id')->on('location_types');
            $table->foreign('parent_id')->references('id')->on('locations');
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

