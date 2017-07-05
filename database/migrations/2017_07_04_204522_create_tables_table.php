<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Table;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type');
            $table->timestamps();
        });

        $tables = [
            ['name' => 'Head Table 1', 'type' => 'rectangle'],
            ['name' => 'Head Table 2', 'type' => 'rectangle'],
            ['name' => 'Head Table 3', 'type' => 'rectangle'],
            ['name' => 'Table 1', 'type' => 'round'],
            ['name' => 'Table 2', 'type' => 'round'],
            ['name' => 'Table 3', 'type' => 'round'],
            ['name' => 'Table 4', 'type' => 'round'],
            ['name' => 'Table 5', 'type' => 'round'],
            ['name' => 'Table 6', 'type' => 'round'],
            ['name' => 'Table 7', 'type' => 'round'],
            ['name' => 'Table 8', 'type' => 'round'],
            ['name' => 'Table 9', 'type' => 'round'],
            ['name' => 'Table 10', 'type' => 'round'],
            ['name' => 'Table 11', 'type' => 'round'],
            ['name' => 'Table 12', 'type' => 'round'],
            ['name' => 'Table 13', 'type' => 'round'],
            ['name' => 'Table 14', 'type' => 'round'],
        ];

        foreach( $tables as $table ) {
            $tableRow = new Table();
            $tableRow->name = $table['name'];
            $tableRow->type = $table['type'];
            $tableRow->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
}
