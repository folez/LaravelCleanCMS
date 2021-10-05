<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageTranslation;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
	public function run()
	{
        $title = "Привет мир!";
		$page = new Page();
        $page->slug = \Str::slug($title);
        $page->save();

        $pageRu = new PageTranslation();
        $pageRu->title = $title;
        $pageRu->name = $title;
        $pageRu->description = $title;
        $pageRu->keywords = $title;
        $pageRu->body = $title;
        $pageRu->language_id = 1;
        $pageRu->page_id = $page->id;
        $pageRu->save();

        $title = 'Hello World!';
        $pageRu = new PageTranslation();
        $pageRu->title = $title;
        $pageRu->name = $title;
        $pageRu->description = $title;
        $pageRu->keywords = $title;
        $pageRu->body = $title;
        $pageRu->language_id = 2;
        $pageRu->page_id = $page->id;
        $pageRu->save();
	}
}
