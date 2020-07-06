<ul class="list-unstyled list-inline">
        @foreach($roles as $role)
        <li>
                <div class="custom-control custom-checkbox mb-3">
                        <input class="custom-control-input" id="customCheck2" type="checkbox" @if(isset($selectedIds) &&
                                in_array($role->id,
                        $selectedIds))checked="checked" @endif @if($data->id == auth()->guard('employee')->user()->id )
                        disabled @endif name="roles[]"
                        value="{{ $role->id }}">
                        <label class="custom-control-label" for="customCheck2">{{ $role->display_name }}</label>
                </div>
        </li>
        @endforeach
</ul>