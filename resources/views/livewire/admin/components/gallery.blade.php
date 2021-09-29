<div class="row">
    <div wire:loading wire:target="galleryItems" class="preloader">
        <div class="loader" role="status"></div>
    </div>
    <div class="col-lg-3 col-12">
        <div class="input-group d-flex flex-column modal-input-field">
            <label for="gallery">Загрузите изображения
                <div class="no-image">
                    <i class="fas fa-plus no-image__icon fa-2x"></i>
                    <span class="no-image__title">Добавить изображение</span>
                </div>
            </label>
            <input type="file" multiple wire:model.defer="images" accept="image/jpeg,image/png,image/pjpeg" id="gallery" class="d-none">
        </div>
    </div>
    <div class="col-12">
        <div class="grid mt-3" drag-root wire:sortable="updateGalleryPriority">
            @if($items)
                @foreach($items as $key => $itm)
                    <div wire:sortable.item="{{ $itm->id }}" wire:key="task-{{ $itm->id }}" class="g-col-md-2 g-col-6 col-12">
                        <label wire:sortable.handle for="galleryItem{{$key}}">
                            <div class="p-2 no-image">
                                @php
                                    $tmp = explode('/',$itm->filename);
                                @endphp
                                <img src="{{route('renderGalleryAdminPreview', ['image' => end($tmp)])}}" alt="" style="object-fit: contain; width: 100%;">
                                <a href="{{asset($itm->filename)}}" data-fancybox class="no-image__zoom">
                                    <i class="far fa-search-plus"></i>
                                </a>
                                <button wire:click.prevent="deleteGalleryItem({{$itm->id}})" class="no-image__delete">
                                    <i class="far fa-times"></i>
                                </button>
                            </div>
                        </label>
                        <input type="file" wire:model.defer="items.{{$key}}" id="galleryItem{{$key}}" class="d-none">
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
