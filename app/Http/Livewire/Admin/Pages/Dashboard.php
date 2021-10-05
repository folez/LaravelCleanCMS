<?php

namespace App\Http\Livewire\Admin\Pages;

use Livewire\Component;

class Dashboard extends Component
{
	public function render()
	{
		return view( 'livewire.admin.pages.dashboard' )->layout('components.layouts.admin.authorized');
	}
}
