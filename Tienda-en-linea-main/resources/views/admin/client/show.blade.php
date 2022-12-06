@extends('layouts.admin')
@section('title','información del cliente')
@section('styles')

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
            {{$client->name}}
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('clients.index')}}">Clientes</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$client->name}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="border-bottom text-center pb-4">
                                <h3>{{$client->name}}</h3>
                                <div class="d-flex justify-content-between">
                                </div>
                            </div>
                            <div class="border-bottom py-4">
                                <div class="list-group">
                                    <a class="list-group-item list-group-item-action active" id="list-home-list"
                                        data-toggle="list" href="#list-home" role="tab" aria-controls="home">
                                        Sobre cliente
                                    </a>
                                    {{--  <button type="button" class="list-group-item list-group-item-action">Registrar
                                        producto</button>  --}}
                                </div>
                            </div>
                        </div>


                        
                        <div class="col-lg-8 pl-lg-5">




                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-home" user="tabpanel"
                                    aria-labelledby="list-home-list">

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Información de cliente</h4>
                                        </div>
                                    </div>
                                    <div class="profile-feed">
                                        <div class="d-flex align-items-start profile-feed-item">
                                            
                                            <div class="form-group col-md-6">
                                                <strong><i class="fab fa-product-hunt mr-1"></i> Nombre</strong>
                                                <p class="text-muted">
                                                    {{$client->name}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-money-check"></i>Saldo total</strong>
                                                <p class="text-muted">
                                                    {{$total}}
                                                </p>
                                                <hr>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <strong>
                                                    <i class="fas fa-address-card mr-1"></i>
                                                    Dirección</strong>
                                                <p class="text-muted">
                                                    {{$client->address}}
                                                </p>
                                                <hr>
                                                <strong><i class="fas fa-mobile mr-1"></i> Teléfono / Celular</strong>
                                                <p class="text-muted">
                                                    {{$client->phone}}
                                                </p>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-profile" user="tabpanel"
                                    aria-labelledby="list-profile-list">

                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>Historial de compras</h4>
                                        </div>
                                    </div>
                   <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Saldo</th>
                                    <th style="width:50px;">Acciones</th>
                                </tr>
                            </thead>
                                    <tbody>
                                @foreach ($compras as $compra)
                                <tr>
                                    <th scope="row">
                                        <a href="{{route('sales.show', $compra->id)}}">{{$compra->id}}</a>
                                    </th>
                                    <td>
                                        {{\Carbon\Carbon::parse($compra->sale_date)->format('d M y h:i a')}}
                                    </td>
                                    <td>{{$compra->total}}</td>
                                    <td>{{$compra->saldo}}</td>
                                  
                                    
                                     <td style="width: 50px;">

                                        <a href="{{route('sales.pdf', $compra->id)}}" class="jsgrid-button jsgrid-edit-button"><i class="far fa-file-pdf"></i></a>
                                        <a href="{{route('payments.create', $compra->id)}}" class="jsgrid-button jsgrid-edit-button"><i class="fas fa-money-check"></i></a>
                                        <a href="{{route('sales.show', $compra->id)}}" class="jsgrid-button jsgrid-edit-button"><i class="far fa-eye"></i></a>
                                   
                                      
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                  </div>


                 </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <a href="{{route('clients.index')}}" class="btn btn-primary float-right">Regresar</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
{!! Html::script('melody/js/profile-demo.js') !!}
{!! Html::script('melody/js/data-table.js') !!}
@endsection
