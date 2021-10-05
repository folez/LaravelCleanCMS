<div>
    <section class="header">
        <div class="row w-100">
            <div class="col-12">
                <div class="route-back d-flex flex-wrap p-2 align-items-end">
                    <h5 class="ps-3 m-0">Настройки</h5>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <form action="" wire:submit.prevent="save" class="w-100 px-2">
            <div class="row w-100">
                @foreach($settingMap as $settingGroup => $settingsKey)
                    @foreach($settingsKey as $settingKey => $settingValue)
                        <div class="col-lg-6">
                            <div class="input-group d-flex flex-column modal-input-field">
                                @switch($settingMapType[$settingGroup][$settingKey])
{{--                                    Text input--}}
                                    @case('input')
                                        <label>{{ucfirst($settingGroup)}} ({{ucfirst($settingKey)}})</label>
                                        <input type="text" class="styled-rounded-accented-input" wire:model="settingMap.{{$settingGroup}}.{{$settingKey}}">
                                    @break
{{--                                Textarea input --}}
                                    @case('textarea')
                                        <label>{{ucfirst($settingGroup)}} ({{ucfirst($settingKey)}})</label>
                                        <textarea style="resize: none" name="" id="" rows="3" class="styled-rounded-accented-input" wire:model="settingMap.{{$settingGroup}}.{{$settingKey}}">
                                            {{$settingMap[$settingGroup][$settingKey]}}
                                        </textarea>
                                    @break
{{--                                File input--}}
                                    @case('file')
                                        <label for="settingMap_{{$settingGroup}}_{{$settingKey}}">
                                            {{ucfirst($settingGroup)}} ({{ucfirst($settingKey)}})
                                            @if($settingMap[$settingGroup][$settingKey])
                                                @if($settingMap[$settingGroup][$settingKey] instanceof \Livewire\TemporaryUploadedFile)
                                                    @if($settingMap[$settingGroup][$settingKey]?->isPreviewable())
                                                    <div class="p-2 no-image">
                                                        <img src="{{$settingMap[$settingGroup][$settingKey]?->temporaryUrl()}}" alt="" class="img-fluid">
                                                        <button wire:click.prevent="deleteImage('{{$settingGroup}}.{{$settingKey}}')" class="no-image__delete">
                                                            <i class="far fa-times fa-2x"></i>
                                                        </button>
                                                    </div>
                                                    @endif
                                                @else
                                                    <div class="p-2 no-image">
                                                        <img src="{{asset($settingMap[$settingGroup][$settingKey])}}" alt="" class="img-fluid">
                                                        <button wire:click.prevent="deleteImage('{{$settingGroup}}.{{$settingKey}}')" class="no-image__delete">
                                                            <i class="far fa-times fa-2x"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="no-image">
                                                    <i class="fas fa-plus no-image__icon fa-2x"></i>
                                                    <span class="no-image__title">Add a image</span>
                                                </div>
                                            @endif
                                            <input type="file" wire:model.defer="settingMap.{{$settingGroup}}.{{$settingKey}}" id="settingMap_{{$settingGroup}}_{{$settingKey}}" class="d-none">
                                        </label>
                                    @break
                                @endswitch
                                @error('settingMap.{{$settingGroup}}.{{$settingKey}}') <span class="error">{{ $message }}</span>  @enderror
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            <div class="col-12 mt-3">
                <button class="btn btn-accent fs-5">Сохранить</button>
            </div>
        </form>
    </section>
</div>
@push('scripts')
    <script>
        window.addEventListener('savedSuccess', () => {
            Swal.fire({
                icon:'success',
                text: 'Настройки успешно сохранены'
            })
        })
    </script>
@endpush
