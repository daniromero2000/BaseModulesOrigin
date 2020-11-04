<p class="alert alert-warning">No hay datos. <a href="{{ route("$optionsRoutes.create") }}">Crear uno</a>
</p>
@php
$searchNull = request()->input();
$searchNull['skip'] = ($skip - 1);
@endphp
<ul class="pagination justify-content-star ">
    <li class="page-item">
        <a class="page-link" id="previous" name="previous" type="submit"
            href="{{ route("$optionsRoutes.index", $searchNull)  }}">
            <i class="fas fa-angle-left"></i>
            <span class="sr-only">Previous</span>
        </a>
    </li>
</ul>