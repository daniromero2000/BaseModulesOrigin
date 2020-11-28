  <div class="row">
      <div class="col-md-6 mx-auto">
          <div class="card">
              <div class="card-header bg-transparent">
                  <h3 class="mb-0">Historial</h3>
              </div>
              @if (!empty($lead->leadManagementStatus))
                  <div class="card-body" style=" max-height: 500px; overflow: auto; ">
                      @foreach ($lead->leadManagementStatus as $data)
                          <div class="timeline timeline-one-side" data-timeline-content="axis"
                              data-timeline-axis-style="dashed">
                              <div class="timeline-block">
                                  <span class="timeline-step"
                                      style="color: {{ $data->status ? $data->status->color : '' }}; background:{{ $data->status ? $data->status->background : '' }}">
                                      <i class="fa fa-clock"></i>
                                  </span>
                                  <div class="timeline-content">
                                      <small
                                          class="text-muted font-weight-bold">{{ $data->created_at->format('M d, Y h:i a') }}</small>
                                      <h5 class=" mt-3 mb-0"><span class="badge"
                                              style="color: {{ $data->status ? $data->status->color : '' }}; background:{{ $data->status ? $data->status->background : '' }}">{{ $data->status ? $data->status->status : 'Sin estado' }}</span>
                                      </h5>
                                      <p class=" text-sm mt-1 mb-0"><b>Usuario:</b> {{ $data->user->name }}
                                      </p>
                                      <div class="mt-3 mb-3">
                                          <span class="badge badge-pill "
                                              style="color: {{ $data->status ? $data->status->color : '' }}; background:{{ $data->status ? $data->status->background : '' }}">
                                              {{ $lead->created_at->diffInHours($data->created_at) }} Horas despues de ser
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
  </div>
