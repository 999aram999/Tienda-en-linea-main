@extends('layouts.admin')
@section('title','Registro de pago')
@section('styles')
{!! Html::style('select/dist/css/bootstrap-select.min.css') !!}
<style type="text/css">
    .unstyled-button {
        border: none;
        padding: 0;
        background: none;
    }

</style>
@endsection
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
            Registro de pago
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('payments.index')}}">Pagos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registro de pago</li>
            </ol>
        </nav>
    </div>
    @foreach ($ventas as $venta)
    <div class="form-group row">
                        <div class="col-md-4 text-center">
                            <label class="form-control-label"><strong>Cliente</strong></label>
                            <p><a href="{{route('clients.show', $venta->client)}}">{{$sale->client->name}}</a></p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label"><strong>Vendedor</strong></label>
                            <p>
                                <a href="{{route('users.show',$venta->user)}}">{{$sale->user->name}}</a>
                            </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <label class="form-control-label"><strong>Número Venta</strong></label>
                            <p>{{$sale->id}}</p>
                        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Registro de Pago</h4>
                    </div>
                    <div class="form-group">
                        <label for="saldo">Saldo Pendiente</label>
                        <input type="number" name="saldo" id="saldo" class="form-control" aria-describedby="helpId" value="{{$sale->saldo}}" required>
                    </div>
                    {!! Form::open(['route'=>'payments.store', 'method'=>'POST','files' => true]) !!}
                   

                    @foreach ($ventas as $venta)
                    <div class="form-group">
                        <label for="sale_id">No. de cuenta</label>
                        <input type="number" name="sale_id" id="sale_id" class="form-control" aria-describedby="helpId" value="{{$sale->id}}" required>
                    </div>
                    @endforeach
                    <div class="form-group">
                        <label for="quantity">Cantidad de pago</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" aria-describedby="helpId" required>
                    </div>

                     <button type="submit" class="btn btn-primary mr-2">Registrar</button>
                     <a href="{{route('payments.index')}}" class="btn btn-light">
                        Cancelar
                     </a>
                     {!! Form::close() !!}
                </div>
                {{--  <div class="card-footer text-muted">
                    {{$products->render()}}
                </div>  --}}
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
{!! Html::script('melody/js/alerts.js') !!}
{!! Html::script('melody/js/avgrund.js') !!}
{!! Html::script('select/dist/js/bootstrap-select.min.js') !!}
{!! Html::script('js/sweetalert2.all.min.js') !!}



@endsection
