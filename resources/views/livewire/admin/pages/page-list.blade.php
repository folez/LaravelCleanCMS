<div>
    <section class="header">
        <div class="row w-100">
            <div class="col-12">
                <div class="route-back d-flex flex-wrap p-2 justify-content-between align-items-center">
                    <h5 class="ps-3 m-0">Страницы</h5>
                    <a href="#" data-bs-target="#createLanguage" data-bs-toggle="modal" class="btn btn-accent py-1 px-2">Добавить <i class="far fa-plus ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row w-100 justify-content-between align-items-end my-2 px-2">
            <div class="table-responsive px-2 w-100">
                <table class="table-collapse styled-table w-100 fs-7">
                    <thead>
                    <tr class="noselect">
                        <td class="text-md-center">#</td>
                        <td class="text-md-center">Название</td>
                        <td class="text-md-center">Ссылка</td>
                        <td class="text-md-center">&nbsp;</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td class="text-md-center text-end px-2" data-label="#">{{$page->id}}</td>
                            <td class="text-md-center text-end px-2" data-label="Имя">{{$page->name}}</td>
                            <td class="text-md-center text-end px-2" data-label="Системное имя">{{$page->slug}}</td>
                            <td class="text-lg-center text-end px-2" width="150" data-label="">
                                <div class="w-100 d-flex flex-md-row flex-column align-items-center justify-content-between justify-content-md-evenly">
                                    <a href="{{route('admin.pages.edit', [ 'id' => $page->id])}}" class="mx-lg-0 m-2 color-black text-decoration-none button-unstyled">
                                        <i class="fal fa-edit fs-4"></i>
                                    </a>
                                    <a href="#" wire:click.prevent="confirmDelete({{$page}})" class="mx-lg-0 m-2 color-black text-decoration-none button-unstyled" >
                                        <i class="fal fs-4 fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </sect
</div>

@push('adminFuntion')
    <script>
        window.addEventListener('swal:confirm', () => {
            Swal.fire({
                title: "Внимание",
                text: "Вы уверены что хотите удалить запись? Данное действие невозможно отменить",
                icon: "info",
                buttons: true,
                confirmButtonText: "Удалить",
                dangerMode: true
            }).then(willDelete => {
                if(willDelete) {
                    @this.deleteItem(e.detail.id);
                }
            });
        });
    </script>
@endpush
