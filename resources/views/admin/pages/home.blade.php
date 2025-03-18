<div class="card">
    <div class="card-header">
        <a href="{{ route('admin.pages.homeSlides.create') }}" class="btn btn-primary">Добавить слайд</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Фото пк</th>
                    <th>Фото моб.</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($homeSlides as $homeSlide)
                    <tr>
                        <td><img src="{{ $homeSlide->web_img }}" class="img-thumbnail t-pc"></td>
                        <td><img src="{{ $homeSlide->mobile_img }}" class="img-thumbnail t-mb"></td>
                        <td>
                            <a href="{{ route('admin.pages.homeSlides.edit', $homeSlide) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
                            <button onclick="destroy('#delete-homeSlide-', '{{ $homeSlide->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                            <form action="{{ route('admin.pages.homeSlides.destroy', $homeSlide) }}" method="POST" id="delete-homeSlide-{{ $homeSlide->id }}">@csrf @method('delete')</form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <a href="{{ route('admin.pages.homeCatalogs.create') }}" class="btn btn-primary">Добавить раздел каталога</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($homeCatalogs as $homeCatalog)
                    <tr>
                        <td>{{ $homeCatalog->name }}</td>
                        <td>{{ $homeCatalog->description }}</td>
                        <td>
                            <a href="{{ route('admin.pages.homeCatalogs.edit', $homeCatalog) }}" class="btn btn-warning btn-xs sharp"><i class="fa fa-edit"></i></a>
                            <button onclick="destroy('#delete-homeCatalog-', '{{ $homeCatalog->id }}')" class="btn btn-danger btn-xs sharp"><i class="fa fa-trash"></i></button>
                            <form action="{{ route('admin.pages.homeCatalogs.destroy', $homeCatalog) }}" method="POST" id="delete-homeCatalog-{{ $homeCatalog->id }}">@csrf @method('delete')</form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

