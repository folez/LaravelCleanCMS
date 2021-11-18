<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
	public function run()
	{
		$gtm = new Settings();

        $gtm->setting_name = 'google';
        $gtm->setting_key = 'tag';
        $gtm->setting_value = '';
        $gtm->save();

		$gta = new Settings();

        $gta->setting_name = 'google';
        $gta->setting_key = 'analytic';
        $gta->setting_value = '';
        $gta->save();

		$fbPixel = new Settings();

        $fbPixel->setting_name = 'facebook';
        $fbPixel->setting_key = 'pixel';
        $fbPixel->setting_value = '';
        $fbPixel->save();

		$telegramToken = new Settings();

        $telegramToken->setting_name = 'telegram';
        $telegramToken->setting_key = 'token';
        $telegramToken->setting_value = '2083614531:AAFce4NZrOV4H89LdD5MUVrRK6g6yN0aIwE';
        $telegramToken->save();

		$telegramChatId = new Settings();

        $telegramChatId->setting_name = 'telegram';
        $telegramChatId->setting_key = 'chat_id';
        $telegramChatId->setting_value = '';
        $telegramChatId->save();

		$seoDefaultTitle = new Settings();

        $seoDefaultTitle->setting_name = 'seo';
        $seoDefaultTitle->setting_key = 'title';
        $seoDefaultTitle->setting_value = 'Digital Lab CMS V2';
        $seoDefaultTitle->save();

		$seoDefaultDescription = new Settings();

        $seoDefaultDescription->setting_name = 'seo';
        $seoDefaultDescription->setting_key = 'description';
        $seoDefaultDescription->setting_value = '';
        $seoDefaultDescription->save();

		$seoDefaultKeywords = new Settings();

        $seoDefaultKeywords->setting_name = 'seo';
        $seoDefaultKeywords->setting_key = 'keywords';
        $seoDefaultKeywords->setting_value = '';
        $seoDefaultKeywords->save();

		$seoDefaultMetaImage = new Settings();

        $seoDefaultMetaImage->setting_name = 'seo';
        $seoDefaultMetaImage->setting_key = 'ogg_image';
        $seoDefaultMetaImage->setting_value = '';
        $seoDefaultMetaImage->setting_type = 'file';
        $seoDefaultMetaImage->save();

		$seoDefaultFavicon = new Settings();

        $seoDefaultFavicon->setting_name = 'global';
        $seoDefaultFavicon->setting_key = 'favicon';
        $seoDefaultFavicon->setting_value = '';
        $seoDefaultFavicon->setting_type = 'file';
        $seoDefaultFavicon->save();
	}
}
