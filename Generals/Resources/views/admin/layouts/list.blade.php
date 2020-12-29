@include('generals::layouts.errors-and-messages')
<div class="card">
    <div class="card-header border-0">
        <h3 class="mb-0">{{ $title }}</h3>
        @include('generals::admin.layouts.search.search', ['route' => route("$optionsRoutes.index")])
    </div>
    @if (!$list->isEmpty())
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        @foreach ($headers as $header)
                            <th class="text-center">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($list as $data)
                        <tr>
                            @foreach ($data->toArray() as $index => $value)
                                @if (!is_array($value) && $index != 'id')
                                    @if ($index == 'created_at')
                                        <td class="text-center">{{ $data->created_at }}</td>
                                    @elseif($index == 'is_active')
                                        <td class="text-center"> @include('generals::layouts.status', ['status' =>
                                            $data->is_active])</td>
                                    @else
                                        <td class="text-center">
                                            {{ $value }}
                                        </td>
                                    @endif
                                @endif
                            @endforeach
                            <td class="text-center">
                                @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                                $optionsRoutes])
                            </td>
                        </tr>
                        @include('generals::admin.layouts.modals.modal_update')
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    @else
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination_null', [$skip, $optionsRoutes])
        </div>
    @endif

</div>
