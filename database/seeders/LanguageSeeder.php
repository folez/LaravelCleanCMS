<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
	public function run()
	{
		$lang = new Language();
        $lang->code = 'ru';
        $lang->name = 'Русский';
        $lang->is_default = true;
        $lang->save();
		$lang = new Language();
        $lang->code = 'en';
        $lang->name = 'English';
        $lang->save();
	}
}
