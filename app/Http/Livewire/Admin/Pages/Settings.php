<?php

namespace App\Http\Livewire\Admin\Pages;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public Collection|null $settings = null;

    public array $settingMap = [];
    public array $settingMapType = [];

    protected function rules() : array
    {
        $rules = [];
        foreach (\App\Models\Settings::all() as $setting){
            $rules["settingMap.{$setting->setting_name}.{$setting->setting_key}"] = ($setting->setting_type == 'file' ? '' : 'string');
        }

        return $rules;
    }

    public function mount()
    {
        $this->settings = \App\Models\Settings::all();

        if(!\Storage::exists('public/global')){
            \Storage::makeDirectory('public/global');
        }

        foreach ($this->settings as $setting){
            $this->settingMap[$setting->setting_name][$setting->setting_key] = $setting->setting_value;
            $this->settingMapType[$setting->setting_name][$setting->setting_key] = $setting->setting_type;
        }
    }

    public function deleteImage( $propertyName )
    {
        $propertyArray = explode('.',$propertyName);
        if( $this->settingMap[$propertyArray[0]][$propertyArray[1]] instanceof TemporaryUploadedFile ) {
            $this->settingMap[$propertyArray[0]][$propertyArray[1]] = '';
        } else {
            $filePath = explode('/',$this->settingMap[$propertyArray[0]][$propertyArray[1]]);
            $fileName = end($filePath);
            Storage::delete('public/global/'.$fileName);

            \App\Models\Settings::setValueByNameAndKey($propertyName, null);

            foreach (\App\Models\Settings::all() as $setting){
                $this->settingMap[$setting->setting_name][$setting->setting_key] = $setting->setting_value;
                $this->settingMapType[$setting->setting_name][$setting->setting_key] = $setting->setting_type;
            }
        }
    }

    public function updated( $propertyName )
    {
        $propertyArray = explode('.',$propertyName);
        if($this->settingMapType[$propertyArray[1]][$propertyArray[2]] == 'file'){
            $tmp = $this->settingMap[$propertyArray[1]][$propertyArray[2]];
        }
    }

    public function save()
    {
        $this->validate();

        foreach ($this->settingMap as $settingGroup => $settingsKey){
            foreach($settingsKey as $settingKey => $settingValue) {
                if( $this->settingMap[$settingGroup][$settingKey] instanceof TemporaryUploadedFile ) {

                    $fileName = uniqid().".".$this->settingMap[$settingGroup][$settingKey]->extension();
                    $tmp = $this->settingMap[$settingGroup][$settingKey]->storeAs('/public/global', $fileName);

                    \App\Models\Settings::setValueByNameAndKey("{$settingGroup}.{$settingKey}", "storage/global/{$fileName}");
                } else {
                    \App\Models\Settings::setValueByNameAndKey("{$settingGroup}.{$settingKey}", $settingValue);
                }
            }
        }

        foreach (\App\Models\Settings::all() as $setting){
            $this->settingMap[$setting->setting_name][$setting->setting_key] = $setting->setting_value;
            $this->settingMapType[$setting->setting_name][$setting->setting_key] = $setting->setting_type;
        }

        $this->dispatchBrowserEvent('savedSuccess', []);
    }

	public function render()
	{
		return view( 'livewire.admin.pages.settings' )->layout('components.layouts.admin.authorized');
	}
}
