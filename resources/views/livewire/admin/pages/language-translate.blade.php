<div>
    <section class="header">
        <div class="row w-100">
            <div class="col-12">
                <div class="route-back d-flex flex-wrap p-2 justify-content-between align-items-center">
                    <h5 class="ps-3 m-0">{{$language->name}} ({{strtoupper($language->code)}})</h5>
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
                        <td class="text-md-center">Название</td>
                        <td class="text-md-center">Ключ</td>
                        <td class="text-md-center">По умолчанию</td>
                        <td class="text-md-center">Перевод</td>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($words as $word)
                            <livewire:admin.components.language.word :word="$word" />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
