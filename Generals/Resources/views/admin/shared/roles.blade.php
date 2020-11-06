<ul class="list-unstyled list-inline row">
        @foreach($roles as $role)
        <li class="col">
                <div class="custom-control custom-checkbox mb-3">
                        <input class="custom-control-input" id="role{{$role->id}}" type="checkbox"
                                @if(isset($selectedIds) && in_array($role->id,
                        $selectedIds))checked="checked" @endif @if($data->id == auth()->guard('employee')->user()->id )
                        disabled @endif name="roles[]"
                        value="{{ $role->id }}">
                        <label class="custom-control-label" for="role{{$role->id}}">{{ $role->display_name }}</label>
                </div>
        </li>
        @endforeach
</ul>