<div>
    <section class="header">
        <div class="row w-100">
            <div class="col-12">
                <div class="route-back d-flex flex-wrap p-2 justify-content-between align-items-center">
                    <h5 class="ps-3 m-0">Меню</h5>
                    <a href="#" wire:click.prevent="newMenu" class="btn btn-accent py-1 px-2">Добавить пункт <i class="far fa-plus ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row w-100 justify-content-between align-items-start my-2 px-2">
            <div class="col-12 col-lg-4">
                <div class="MenuManager_root">
                    <livewire:admin.components.menu.wrapper class-name="MenuManager_branch" item-key="0" :model-class="\App\Models\Menu::class" :elements="$items" />
                </div>
            </div>
            @if($item)
            <div class="col-lg-8">
                <div class="row" style="border-left: 2px solid #dedede">
                    <div class="col-12">
                        <h5>@if($isEditMode) Редактирование меню {{$item->name}} @else Добавление пункта @endif</h5>
                        <form action="#" class="row" wire:submit.prevent="saveMenu">
                            <div class="col-12 mb-3">
                                <label for="type_link">
                                    <input type="radio" wire:model="item.type" @if($item->type == 'link' ) checked @endif id="type_link" name="type" value="link">
                                    <span>Внешняя ссылка</span>
                                </label>
                                <label for="type_page" class="ms-2">
                                    <input type="radio" wire:model="item.type" @if($item->type == 'page') checked @endif name="type" id="type_page" value="page">
                                    <span>Страница</span>
                                </label>
                                <label for="type_dropdown" class="ms-2">
                                    <input type="radio" id="type_dropdown" wire:model="item.type" @if($item->type == 'dropdown') checked @endif name="type" value="dropdown">
                                    <span>Выпадающий список</span>
                                </label>
                            </div>
                            @switch($item->type)
                                @case('link')
                                <div class="col-12 mb-3">
                                    <div class="input-group d-flex flex-column modal-input-field">
                                        <label>Ссылка</label>
                                        <input type="text" class="styled-rounded-accented-input" wire:model="item.link">
                                    </div>
                                    @error('item.link') <span class="error">{{ $message }}</span>  @enderror
                                </div>
                                @break
                                @case('page')
                                <div class="col-12 mb-3">
                                    <div class="input-group d-flex flex-column modal-input-field">
                                        <label for="item_type-dropdown">Страница</label>
                                        <select name="item_type-dropdown" id="item_type-dropdown" wire:change="$set('item.page_id',$event.target.value)">
                                            @foreach(\App\Models\Page::languageCode()->get() as $page)
                                                <option @if($item->page_id == $page->id) selected @endif value="{{$page->id}}">{{$page->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('item.page_id') <span class="error">{{ $message }}</span>  @enderror
                                @break
                            @endswitch
                            <div class="col-12">
                                @if($isEditMode)
                                    <livewire:admin.components.language.wrapper :callback-func="$item->type == 'page' ? \App\Http\Livewire\Admin\Pages\MenuList::class : null" wire:key="{{$item->id}}" :key="$item->id" :model-id="$item?->id" primary-key="menu_id" :model="\App\Models\MenuTranslation::class"/>
                                @else
                                    <livewire:admin.components.language.wrapper :callback-func="$item->type == 'page' ? \App\Http\Livewire\Admin\Pages\MenuList::class : null" :model-id="$item?->id" primary-key="menu_id" :model="\App\Models\MenuTranslation::class"/>
                                @endif
                            </div>
                            <div class="col-12 mt-3 d-flex justify-content-start">
                                <div>
                                    <button type="submit"  class="btn btn-save">Сохранить <i class="fal fa-save ms-2"></i></button>
                                    <button type="button" class="btn btn-back" wire:click="cancel">Отмена</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>
@push('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
    <script src="{{asset('shared/assets/js/jquery.mjs.nestedSortable.js')}}"></script>
    <script>
        var sortOptions = {
            forcePlaceholderSize: true,
            handle: 'div',
            helper: 'clone',
            maxLevels: 2,
            items: '[data-role="menuNode"]',
            isTree: true,
            errorClass: 'MenuManager_emptyError',
            placeholder: 'MenuManager_emptyHover',
            start: () => {},
            toleranceElement: '> div',
            tabSize: 30,
            update: () => {
                let sortableArray = $('.MenuManager_root > ol').nestedSortable('toArray', { startDepthCount: 1 });
                @this.updatePriority(sortableArray)
            }
        };

        $('.MenuManager_root > ol').nestedSortable(sortOptions);
    </script>
    <script>
        window.addEventListener('isPage', () => {
            let element = document.querySelector('[name="item_type-dropdown"]');
            let choiceInstance = new Choices(element,{
                removeItemButton: false,
                searchPlaceholderValue: 'Введите название страницы',
                noChoicesText: 'Нед доступных страниц',
                itemSelectText: 'Нажмите чтобы выбрать',
            });
        })
    </script>
    <script>
        window.addEventListener('isPage', () => {
            let element = document.querySelector('[name="item_type-dropdown"]');
            let choiceInstance = new Choices(element,{
                removeItemButton: false,
                searchPlaceholderValue: 'Введите название страницы',
                noChoicesText: 'Нед доступных страниц',
                itemSelectText: 'Нажмите чтобы выбрать',
            });
        })
        window.addEventListener('savedMenu', () => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-right',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })

            Toast.fire({
                icon: 'success',
                title: 'Успешно',
                text: "Пункт меню сохранен"
            })
        })
    </script>
@endpush
