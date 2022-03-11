<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
	    $user = User::create([
	        'name'     => 'FoLez',
            'email'    => 'admin@example.com',
            'password' => \Hash::make('GitHub123@')
        ]);
		//
	}
}
