<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
	    $user = User::create([
	        'name'     => 'DigitalLab',
            'email'    => 'dev@digitallab.com.ua',
            'password' => \Hash::make('Digital123@')
        ]);
		//
	}
}
