<div>
    <section class="header">
        <div class="row w-100">
            <div class="col-12">
                <div class="route-back d-flex flex-wrap p-2 align-items-end">
                    <h5 class="ps-3 m-0">{!!$isEditMode?"Редактирование страницы: <b wire:ignote.self>{$page->title}</b>":'Добавление страницы'!!}</h5>
                </div>
            </div>
        </div>
    </section>
    <section class="content pb-3">
        <form action="" wire:submit.prevent="save" class="w-100 px-2">
            <div class="row g-0">
                <div class="row w-100">
                    <div class="col-lg-3 col-12 mb-2">
                        <div class="input-group d-flex flex-column modal-input-field">
                            <label for="image">Выберите изображение
                                <div class="no-image">
                                    <i class="fas fa-plus no-image__icon fa-2x"></i>
                                    <span class="no-image__title">Добавить изображение</span>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-9">
                        <livewire:admin.components.language.wrapper :model-id="$page?->id" primary-key="page_id"  :model="\App\Models\PageTranslation::class"/>
                    </div>
                </div>
                <div class="row w-100 mt-5">
                    <div class="col-12 d-flex justify-content-start">
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="cancel">Отмена</button>
                            <button type="submit"  class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
