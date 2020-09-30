@if ($bestSellers->isNotEmpty())
<div>
    @include('ecommerce::layouts.front.card-product',['title' => 'LOS MAS VENDIDOS',
    'background'=>'carrousel-reset-home'])
</div>
@endif