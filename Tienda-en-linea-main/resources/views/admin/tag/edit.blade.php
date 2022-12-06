@extends('layouts.admin')
@section('title','Editar etiqueta')
@section('styles')
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Editar etiqueta
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('tags.index')}}">Etiquetas</a></li>
                <li class="breadcrumb-item active" aria-current="page">Editar {{$tag->name}}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    
                
                    {!! Form::model($tag,['route'=>['tags.update',$tag], 'method'=>'PUT']) !!}
                    

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" value="{{$tag->name}}" class="form-control form-control @error('name') is-invalid @enderror" placeholder="Nombre" required>
                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                
                       @enderror
                      </div>
                      <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea class="form-control form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">
                    {{$tag->description}}
                    </textarea>
                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                
                       @enderror
                    </div>
      
                     <button type="submit" class="btn btn-primary mr-2">Actualizar</button>
                     <a href="{{route('tags.index')}}" class="btn btn-light">
                        Cancelar
                     </a>
                     {!! Form::close() !!}
                </div>
                {{--  <div class="card-footer text-muted">
                    {{$tags->render()}}
                </div>  --}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
@endsection
