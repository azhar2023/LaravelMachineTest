<?php

use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('designations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Designation::insert([
            ['name' => 'Marketing Manager'],
            ['name' => 'Mobile Application Dev'],
            ['name' => 'Account Manager'],
        ]);

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Department::insert([
            ['name' => 'Marketing'],
            ['name' => 'Mobile Application Development'],
            ['name' => 'Accounts'],
        ]);

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('fk_department')->nullable(); // Add this column
            $table->unsignedBigInteger('fk_designation')->nullable();
            $table->bigInteger('phone_number');
            $table->timestamps();
            $table->foreign('fk_department')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('fk_designation')->references('id')->on('designations')->onDelete('cascade')->onUpdate('cascade');
        });

        User::insert([
            [
                'name' => 'John Due',
                // 'fk_department' => $designation[1], 
                // 'fk_designation' => $department[1], 
                'phone_number' => 123347890,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tommy Marks',
                // 'fk_department' => $designation[2], 
                // 'fk_designation' => $department[2], 
                'phone_number' => 9876543210,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Azhar',
                // 'fk_department' => $designation[2], 
                // 'fk_designation' => $department[2], 
                'phone_number' => 9746991438,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ashif',
                // 'fk_department' => $designation[2], 
                // 'fk_designation' => $department[2], 
                'phone_number' => 9745382113,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vyshakh',
                // 'fk_department' => $designation[2], 
                // 'fk_designation' => $department[2], 
                'phone_number' => 9745334413,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sona',
                // 'fk_department' => $designation[2], 
                // 'fk_designation' => $department[2], 
                'phone_number' => 8976564547,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $departments = Department::all();
        $designations = Designation::all();
        $users = User::get();

        foreach ($users as $key =>  $user) {

            $department = $departments[$key % $departments->count()];
            $designation = $designations[$key % $designations->count()];
            $user->fk_department = $department->id;
            $user->fk_designation = $designation->id;
            $user->save();
        }
        


    }

  
};
