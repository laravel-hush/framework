<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use ScaryLayer\Hush\Models\Role;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key', 50)->unique();
            $table->timestamps();
        });

        (new Role)->createTranslationTable();

        Schema::create('role_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role', 50);
            $table->string('permission', 150);
            $table->timestamps();

            $table->unique(['role', 'permission']);
            $table->foreign('role')->references('key')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
}
