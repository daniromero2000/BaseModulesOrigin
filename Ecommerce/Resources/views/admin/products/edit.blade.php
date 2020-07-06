@extends('generals::layouts.admin.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/carousel/glider.css')}}">
<script src="{{ asset('js/front/carousel/glider.js')}}"></script>
<script src="{{ asset('js/admin/carousel.js')}}"></script>
<style type="text/css">
    label.checkbox-inline {
        padding: 10px 5px;
        display: block;
        margin-bottom: 5px;
    }

    label.checkbox-inline>input[type="checkbox"] {
        margin-left: 10px;
    }

    ul.attribute-lists>li {
        margin-bottom: 10px;
    }

    .center {
        left: 50%;
        transform: translateX(0) !important;
    }

    .info-tooltip {
        position: absolute;
        top: 3px;
        right: 18px;
        border-radius: 20px;
        background: #5e72e4;
        width: 18px;
        cursor: pointer;
        font-size: 12px;
        text-decoration: none;
        color: white !important;
    }

    .relative {
        position: relative;
    }

    .remove-img {
        position: absolute;
        top: 5px;
        width: 29px;
        right: 5px;
    }

    @media (max-width: 700px) {
        .remove-img {
            width: 0px;
            padding-right: 12px;
            right: 0px;
            font-size: 8px;
        }
    }
</style>
@endsection
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/admin/products">Productos</a></li>
                            <li class="breadcrumb-item active" active aria-current="page">{{ ucfirst($product->name) }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="nav-wrapper">
        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 @if(!request()->has('combination')) active @endif" id="info-tab"
                    data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">
                    <i class="ni ni-cloud-upload-96 mr-2"></i>Información
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 @if(request()->has('combination')) active @endif"
                    id="combinations-tab" data-toggle="tab" href="#combinations" role="tab" aria-controls="combinations"
                    aria-selected="false">
                    <i class="ni ni-bell-55 mr-2"></i>Combinaciones
                </a>
            </li>
        </ul>
    </div>
    <div class="card">
        <form action="{{ route('admin.products.update', $product->id) }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <h4>{{ csrf_field() }}</h4>

                    <input type="hidden" name="_method" value="put">
                    <div class="col-md-12">
                        <div class="tab-content" id="tabcontent">
                            <div role="tabpanel" class="tab-pane @if(!request()->has('combination')) active @endif"
                                id="info">
                                <div class="col pl-0 mb-3">
                                    <h2>{{ ucfirst($product->name) }}</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 col-lg-6">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="sku">SKU</label>
                                                    <div class="input-group input-group-merge">

                                                        <input type="text" name="sku" id="sku" placeholder="xxxxx"
                                                            class="form-control" value="{!! $product->sku !!}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="quantity">Cantidad</label>
                                                    @if($productAttributes->isEmpty())
                                                    <input type="text" name="quantity" id="quantity"
                                                        placeholder="Quantity" class="form-control"
                                                        value="{!! $product->quantity  !!}">
                                                    @else
                                                    <input type="hidden" name="quantity" value="{{ $qty }}">

                                                    <input type="text" value="{{ $qty }}" class="form-control" disabled>
                                                    @endif
                                                    @if(!$productAttributes->isEmpty())<a
                                                        class="text-center info-tooltip" data-toggle="tooltip"
                                                        data-original-title="La cantidad esta deshabilitada. La cantidad total es calculada por la suma de todas las combinaciones">
                                                        ? </a> @endif

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="name">Nombre</label>
                                                    <input type="text" name="name" id="name" placeholder="Name"
                                                        class="form-control" value="{!! $product->name !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="price">Precio</label>
                                                    @if($productAttributes->isEmpty())
                                                    <div class="input-group">
                                                        <input type="text" name="price" id="price" placeholder="Price"
                                                            class="form-control" value="{!! $product->price !!}">
                                                    </div>
                                                    @else
                                                    <input type="hidden" name="price" value="{!! $product->price !!}">
                                                    <div class="input-group">
                                                        <input type="text" id="price" placeholder="Price"
                                                            class="form-control" value="{!! $product->price !!}"
                                                            disabled>
                                                    </div>
                                                    @endif
                                                    @if(!$productAttributes->isEmpty())
                                                    <a class="text-center info-tooltip" data-toggle="tooltip"
                                                        data-original-title="El precio
                                                        está deshabilitado.
                                                        El precio está basado en las combinaciones">
                                                        ? </a>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="sale_price">Precio de
                                                        oferta</label>
                                                    <div class="input-group">
                                                        <input type="text" name="sale_price" id="sale_price"
                                                            placeholder="Sale Price" class="form-control"
                                                            value="{{ $product->sale_price }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Categorias</label>
                                                    @include('ecommerce::admin.shared.categories', ['categories' =>
                                                    $categories,
                                                    'ids' => $product])
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-control-label">Grupos</label>
                                                    @include('ecommerce::admin.shared.product_groups', ['product_groups'
                                                    =>
                                                    $product_groups,
                                                    'ids' => $product])
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                @if(!$brands->isEmpty())
                                                <div class="form-group">
                                                    <label class="form-control-label" for="brand_id">Marca</label>
                                                    <select name="brand_id" id="brand_id" class="form-control select2">
                                                        <option value=""></option>
                                                        @foreach($brands as $brand)
                                                        <option @if($brand->id == $product->brand_id)
                                                            selected="selected" @endif
                                                            value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-sm  -6">
                                                <div class="form-group">
                                                    @include('ecommerce::admin.shared.status-select', ['status' =>
                                                    $product->is_active])
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                @include('ecommerce::admin.shared.attribute-select',
                                                [compact('default_weight')])
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="description">Descripción</label>
                                                    <textarea class="form-control ckeditor" name="description"
                                                        id="description" rows="5"
                                                        placeholder="Description">{!! $product->description  !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="cover">Cover</label>
                                            <div class="row">
                                                <img src="{{ $product->cover }}" alt=""
                                                    style="max-height: 170px; margin: 0px auto;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="cover" id="cover" class="form-control">
                                        </div>
                                        <div class="px-sm-5 px-3 pb-5">
                                            <div class="glider-contain">
                                                <div class="glider3">
                                                    @foreach($images as $image)
                                                    <div class="card-body">
                                                        <div style=" position: relative; ">
                                                            <img src="{{ asset("storage/$image->src") }}"
                                                                alt="{{ $image->src }}"
                                                                style="border-radius: 15px;max-height: 220px;">
                                                            <a onclick="return confirm('¿Estás Seguro?')"
                                                                href="{{ route('admin.product.remove.thumb', ['src' => $image->src]) }}"
                                                                class="btn btn-danger remove-img btn-sm btn-block">X</a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <button type="button" class="glider-prev"><i
                                                        class="fas fa-angle-left"></i></button>
                                                <button type="button" class="glider-next"><i
                                                        class="fas fa-angle-right"></i></button>
                                                <div id="dots"></div>
                                            </div>
                                        </div>
                                        <div class="relative">
                                            <div class="form-group">
                                                <label class="form-control-label" for="image">Imagenes</label>
                                                <input type="file" name="image[]" id="image" class="form-control"
                                                    multiple>
                                                <a class="text-center info-tooltip" data-toggle="tooltip"
                                                    data-original-title="Puedes usar (cmd) para seleccionar
                                                    multiples
                                                    imagenes">
                                                    ! </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card-footer ml-auto pb-0">
                                        <a href="{{ route('admin.products.index') }}"
                                            class="btn btn-default btn-sm">Regresar</a>
                                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane @if(request()->has('combination')) active @endif"
                                id="combinations">
                                <div class="col pl-0 mb-3">
                                    <h2>Crear combinaciones</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 order-md-last">
                                        @include('ecommerce::admin.products.attributes',
                                        compact('productAttributes'))
                                    </div>
                                    <div class="col-md-6">
                                        @include('ecommerce::admin.products.create-attributes',
                                        compact('attributes'))
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')

<script type="text/javascript">
    function backToInfoTab() {
            $('#tablist > li:first-child').addClass('active');
            $('#tablist > li:last-child').removeClass('active');

            $('#tabcontent > div:first-child').addClass('active');
            $('#tabcontent > div:last-child').removeClass('active');
        }
        $(document).ready(function () {
            const checkbox = $('input.attribute');
            $(checkbox).on('change', function () {
                const attributeId = $(this).val();
                if ($(this).is(':checked')) {
                    $('#attributeValue' + attributeId).attr('disabled', false);
                } else {
                    $('#attributeValue' + attributeId).attr('disabled', true);
                }
                const count = checkbox.filter(':checked').length;
                if (count > 0) {
                    $('#productAttributeQuantity').attr('disabled', false);
                    $('#productAttributePrice').attr('disabled', false);
                    $('#salePrice').attr('disabled', false);
                    $('#default').attr('disabled', false);
                    $('#createCombinationBtn').attr('disabled', false);
                    $('#combination').attr('disabled', false);
                } else {
                    $('#productAttributeQuantity').attr('disabled', true);
                    $('#productAttributePrice').attr('disabled', true);
                    $('#salePrice').attr('disabled', true);
                    $('#default').attr('disabled', true);
                    $('#createCombinationBtn').attr('disabled', true);
                    $('#combination').attr('disabled', true);
                }
            });
        });
</script>
@endsection