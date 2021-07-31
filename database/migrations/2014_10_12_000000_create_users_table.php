<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('hp', 15)->nullable();
            $table->char('provinsi_id', 2)->collation('utf8_unicode_ci');
            $table->char('kota_id', 4)->collation('utf8_unicode_ci');
            $table->char('kecamatan_id', 7)->collation('utf8_unicode_ci');
            $table->string('alamat', 300)->nullable();
            $table->string('role', 50)->default('user');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('provinsi_id')->references('id')->on('provinces')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kota_id')->references('id')->on('regencies')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kecamatan_id')->references('id')->on('districts')->onUpdate('cascade')->onDelete('cascade');
        });

        DB::table('users')->insert(
            [
                'id' => 1,
                'name' => 'Superadmin App',
                'email' => 'ahmadbagwi.id@gmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('qwerty123'),
                'hp' => '085719191852',
                'provinsi_id' => 32,
                'kota_id' => 3201,
                'kecamatan_id' => 3201050,
                'alamat' => 'Jl. Rasamala No. 2',
                'role' => 'superadmin',
            ]
        );

        DB::table('users')->insert(
            [
                'id' => 2,
                'name' => 'Admin App',
                'email' => 'admin@gmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('qwerty123'),
                'hp' => 85719191852,
                'provinsi_id' => 32,
                'kota_id' => 3201,
                'kecamatan_id' => 3201050,
                'alamat' => 'Jl. Jenderal Sudirman',
                'role' => 'admin',
            ]
        );

        DB::table('users')->insert(
            [
                'id' => 3,
                'name' => 'Nismara',
                'email' => 'nismara@gmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('qwerty123'),
                'hp' => 85719191852,
                'provinsi_id' => 32,
                'kota_id' => 3201,
                'kecamatan_id' => 3201050,
                'alamat' => 'jl. jeruk no 12',
                'role' => 'user'
            ]
        );
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
