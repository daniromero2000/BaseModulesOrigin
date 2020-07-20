@if(!$productAttributes->isEmpty())
<p class="alert alert-info">Solo puede establecer 1 combinación como predeterminada</p>
<ul class="list-unstyled">
    <li>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light text-center">
                    <tr>
                        <th>Cantidad</th>
                        <th>Precio Normal</th>
                        <th>Precio oferta</th>
                        <th>Atributos</th>
                        <th>Por Defecto?</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($productAttributes as $pa)
                    <tr>
                        <td>{{ $pa->quantity }}</td>
                        <td>${{ number_format($pa->price, 0) }}</td>
                        <td>${{ number_format($pa->sale_price,0) }}</td>
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
                            <a data-toggle="modal" data-target="#product-attribute{{$pa->id}}" href=""
                                class="table-action table-action" data-toggle="tooltip" data-original-title="Editar">
                                <i class="fas fa-user-edit"></i></a>
                            <!-- Modal -->
                            <div class="modal fade" id="product-attribute{{$pa->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar
                                                combinaciones</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @include('ecommerce::admin.products.edit-attributes')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a onclick="return confirm('¿Estás Seguro?')"
                                href="{{ route('admin.products.edit', [$pa->id, 'combination' => 1, 'delete' => 1, 'pa' => $pa->id]) }}"
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
<p class="alert alert-warning">No hay combinaciones aún.</p>
@endif