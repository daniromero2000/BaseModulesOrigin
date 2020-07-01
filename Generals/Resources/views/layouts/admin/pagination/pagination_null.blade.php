<p class="alert alert-warning">No hay datos. <a href="{{ route("$optionsRoutes.create") }}">Crear uno</a>
</p>
<ul class="pagination justify-content-start ">
    <li class="page-item">
        <a class="page-link" id="previous" name="previous" type="submit"
            href="{{ route("$optionsRoutes.index", ['skip' => ($skip - 1)] ) }}" @if ($skip<1 ) hidden @endif>
            <i class="fas fa-angle-left"></i>
            <span class="sr-only">Previous</span>
        </a>
    </li>
</ul>