<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('forename');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('phone_number');
            $table->integer('type');
            $table->timestamps();
        });

        // Every time we make the table, make the admin user.
        $user = new User();
        $user->forename = "admin";
        $user->surname = "admin";
        $user->email = "admin@domain.com";
        $user->password = Hash::make("admin");
        $user->phone_number = "012101210121";
        $user->type = 1;

        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
