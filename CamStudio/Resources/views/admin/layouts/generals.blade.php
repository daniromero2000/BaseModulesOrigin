<div class="card card-profile">
    <img src="{{ asset("storage/$cammodel->cover_page") }}" alt="Image placeholder" class="card-img-top"
        style=" max-width: 600px; margin: auto; ">
    <a class="bg-primary text-white" data-toggle="modal" data-target="#modal-default"
        style="width: 35px;height: 35px;border-radius: 25px;position: absolute;top: 7px;right: 10px;display: flex;">
        <i class="fas fa-pen m-auto"></i>
    </a>
    <div class="row justify-content-center">
        <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
                <a data-toggle="modal" data-target="#modal-cover">
                    <img src="{{ asset("storage/$cammodel->cover") }}" class="rounded-circle"> </a>
            </div>
        </div>
    </div>
    <div class="card-header text-center border-0 pt-5 pt-md-4 pb-0 pb-md-4">
        {{-- <div class="d-flex justify-content-between">
            <a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
            <a href="#" class="btn btn-sm btn-default float-right">Message</a>
        </div> --}}
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <div class="col">
                <div class="card-profile-stats d-flex justify-content-center">
                    <div>
                        <span class="heading">{{count($cammodel->images)}}</span>
                        <span class="description">Whislist</span>
                    </div>
                    <div>
                        <span class="heading">{{count($cammodel->images)}}</span>
                        <span class="description">Imagenes</span>
                    </div>
                    <div>
                        <span class="heading">89</span>
                        <span class="description">Comentarios</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <h5 class="h3">
                {{$cammodel->nickname}}<span class="font-weight-light">, {{$cammodel->fake_age}}</span>
            </h5>
            {{-- <div class="h5 font-weight-300">
                <i class="ni location_pin mr-2"></i>Bucharest, Romania
            </div>
            <div class="h5 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
            </div>
            <div>
                <i class="ni education_hat mr-2"></i>University of Computer Science
            </div> --}}
        </div>
    </div>
</div>