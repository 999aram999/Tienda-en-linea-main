@extends('layouts.admin')
@section('title','Gestión de pedidos')
@section('styles')
<style type="text/css">
    .unstyled-button {
        border: none;
        padding: 0;
        background: none;
      }
</style>
@endsection
@section('styles')
@section('create')

@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Pedidos
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pedidos</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Pedidos</h4>
                       
                    </div>

                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                <th>Pedido</th>
                                 <th>Fecha</th>
                                 <th>Estado</th>
                                 <th>Total</th>
                                 <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key=> $order)
                                <tr>
                                    <th scope="row">{{$order->id}}</th>
                                    <td>
                                    {{$order->order_date}}
                                    </td>

                                    <td> 
                                        <a 
                                        href="#" 
                                        id="username"
                                        class="editable"
                                         data-type="select" 
                                         data-pk="{{$order->id}}" 
                                         data-url="{{url("/orders_update/$order->id")}}" 
                                         data-title="Estado"
                                        data-value="{{ $order->shopping_status }}"
                                        >{{$order->shopping_status()}}
                                        </a>
                                    </td>


                                    <td> {{$order->total()}}</td>
                                    <td style="width: 50px;">
                                  
                                        <a class="jsgrid-button jsgrid-edit-button" href="{{route('orders.show', $order)}}" title="Ver detalles">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        
                          
                                    </td>
                                </tr>
                                </div>
                 
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{--  <div class="card-footer text-muted">
                    {{$categories->render()}}
                </div>  --}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
{!! Html::script('editable/jqueryui-editable/js/jqueryui-editable.min.js') !!}

<script>
    $.fn.editable.defaults.mode='inline';
    $.fn.editable.defaults.ajaxOptions = {type: 'PUT'};
    $(document).ready(function() {
    $('.editable').editable({
        source:[
            {value: "PENDING", text: "PENDIENTE"},
            {value: "APPROVED", text: "APROBADO"},
            {value: "CANCELED", text: "CANCELADO"},
            {value: "DELIVERED", text: "ENTREGADO"},
        ]
    });
});
</script>
@endsection
