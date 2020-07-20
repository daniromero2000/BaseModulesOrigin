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
      @if($datas)
      @foreach($datas as $data)
      <tr>
        @foreach($data->toArray() as $key => $value)
        <td class="text-center">
          {{ $data[$key] }}
        </td>
        @endforeach
        @foreach ($data->department as $department )
        <td class="text-center">@if($department->name != ''){{ $department->name }}@else NA @endif</td>
        @endforeach
        <td class="text-center">
          @include('generals::layouts.status', ['status' => $data->is_active])</td>
        <td class="text-center">
          @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' => $optionsRoutes])
        </td>
      </tr>
      <!-- Modal -->
      @include('companies::layouts.edit_employee')
      @endforeach
      @endif
    </tbody>
  </table>
</div>