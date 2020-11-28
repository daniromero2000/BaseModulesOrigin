<div class="col-md-4">
    <div class="card">
        <div class="card-header bg-transparent">
            <h3 class="mb-0">Historial</h3>
        </div>

        @if(!Empty($datas))
        <div class="card-body" style=" max-height: 500px; overflow: auto; ">
            @foreach($datas as $data)

            <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                <div class="timeline-block">
                    <span class="timeline-step"
                        style="color: {{$data->status->color}}; background:{{ $data->status->background}}">
                        <i class="fa fa-clock"></i>
                    </span>
                    <div class="timeline-content">
                        <small class="text-muted font-weight-bold">{{$data->created_at->format('M d, Y h:i a')}}</small>
                        <h5 class=" mt-3 mb-0"><span class="badge"
                                style="color: {{$data->status->color}}; background:{{ $data->status->background}}">{{ $data->status->status}}</span>
                        </h5>
                        <p class=" text-sm mt-1 mb-0"><b>Usuario:</b> {{$data->user->name}}</p>
                        <div class="mt-3 mb-3">
                            <span class="badge badge-pill "
                                style="color: {{$data->status->color}}; background:{{ $data->status->background}}">
                                {{$lead->created_at->diffInHours($data->created_at)}} de ser
                                creado</span>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach

        </div>
        @endif

    </div>

</div>