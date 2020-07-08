@if(Empty(!$products))
<div class="table-responsive">
    <table class="table align-items-center table-flush table-hover">
        <thead class="thead-light">
            <tr>
                <td>ID</td>
                <td>Nombre</td>
                <td>Cantidad</td>
                <td>Precio</td>
                <td>Estado</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    {{ $product->name }}
                </td>
                <td>{{ $product->quantity }}</td>
                <td>{{ config('cart.currency') }} {{ $product->price }}</td>
                <td>@include('generals::layouts.status', ['status' => $product->is_active])</td>

                <td class="table-actions">
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="post"
                        class="form-horizontal">
                        {{ csrf_field() }}
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="table-action table-action"
                            data-toggle="tooltip" data-original-title="Editar">
                            <i class="fas fa-user-edit"></i>
                        </a>
                        <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                            class="table-action table-action-delete button-reset" data-toggle="tooltip"
                            data-original-title="Borrar">
                            <i class="fas fa-trash"></i>
                        </button>
                        <input type="hidden" name="_method" value="delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif