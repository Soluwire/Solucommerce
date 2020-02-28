<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\MenuItem;
class CreateMenuitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuitems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('menu_order');
            $table->string('menu_item_name');
            $table->integer('page_id')->nullable();

            $table->timestamps();
        });

        $menuitem = new MenuItem();
        $menuitem->menu_order = 1;
        $menuitem->menu_item_name = "Home";
        $menuitem->save();

        $menuitem = new MenuItem();
        $menuitem->menu_order = 2;
        $menuitem->menu_item_name = "Products";
        $menuitem->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menuitems', function (Blueprint $table) {
            Schema::drop('menuitems');
        });
    }
}
