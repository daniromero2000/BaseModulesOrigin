@if(!$productAttributes->isEmpty())
<p class="alert alert-info">Solo puede establecer 1 combinación como predeterminada</p>
<ul class="list-unstyled">
    <li>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light text-center">
                    <tr>
                        <th>ID</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Sale Price</th>
                        <th>Atributos</th>
                        <th>Is default?</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($productAttributes as $pa)
                    <tr>
                        <td>{{ $pa->id }}</td>
                        <td>{{ $pa->quantity }}</td>
                        <td>{{ $pa->price }}</td>
                        <td>{{ $pa->sale_price }}</td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach($pa->attributesValues as $item)
                                <li>{{ $item->attribute->name }} : {{ $item->value }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @if($pa->default == 1)
                            <button class="btn btn-success"><i class="fa fa-check"></i></button>
                            @else
                            <button class="btn btn-danger"><i class="fa fa-remove"></i></button>
                            @endif
                        </td>
                        <td class="table-actions">
                            <a onclick="return confirm('Are you sure?')"
                                href="{{ route('admin.products.edit', [$product->id, 'combination' => 1, 'delete' => 1, 'pa' => $pa->id]) }}"
                                class="table-action table-action-delete button-reset" data-toggle="tooltip"
                                data-original-title="Borrar">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </li>
</ul>
@else
<p class="alert alert-warning">No combination yet.</p>
@endif