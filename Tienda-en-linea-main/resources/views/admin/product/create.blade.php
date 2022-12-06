@extends('layouts.admin')
@section('title','Registrar producto')
@section('styles')
{!! Html::style('select/dist/css/bootstrap-select.min.css') !!}
{!!Html::style('select2/dist/css/select2.min.css')!!}
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Registro de productos
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('products.index')}}">Productos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registro de productos</li>
            </ol>
        </nav>
    </div>
    {!! Form::open(['route'=>'products.store', 'method'=>'POST','files' => true]) !!}
    <div class="row">
    
                <div class="col-md-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <!-- <div class="d-flex justify-content-between">
                        <h4 class="card-title">Registro de productos</h4>
                        </div> -->
                           
                   

                      <div class="form-group">
                       <label for="name">Nombre</label>
                       <input type="text" name="name" id="name" class="form-control" aria-describedby="helpId" required>
                     </div>
                    <div class="form-group">
                      <label for="code">Código de barras</label>
                      <input type="text" name="code" id="code" class="form-control">
                      <small id="helpId" class="text-muted">Campo opcional</small>
                     </div>
                     <div class="form-row">
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="sell_price">Precio Contado</label>
                                <input type="number" name="sell_price" id="sell_price" class="form-control" aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cred_price">Precio Crédito</label>
                                <input type="number" name="cred_price" id="cred_price" class="form-control" aria-describedby="helpId" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                           <label for="stock">Stock</label>
                           <input type="number" name="stock" id="stock" class="form-control" aria-describedby="helpId" required>
                           </div>
                        </div>
                    </div>

                   
                        <div class="form-group">
                          <label for="short_description">Extracto</label>
                          <textarea class="form-control" name="short_description" id="short_description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="long_description">Descripción</label>
                          <textarea class="form-control" name="long_description" id="long_description" rows="10"></textarea>
                        </div>
                    
   
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <div class="form-group">
                      <label for="category">Categoría</label>
                      <!-- <select class="form-control"  id="category"> -->
                      <select class="form-control selectpicker" data-live-search="true" id="category">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                    </div>
                     <div class="form-group">
                      <label for="subcategory_id">Subcategoría</label>
                      <select class="form-control selectpicker" data-live-search="true" name="subcategory_id" id="subcategory_id">
                        @foreach ($subcategories as $subcategory)
                        <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="tags">Etiquetas</label>
                      <select class="select2" name="tags[]" id="tags" style="width: 100%" multiple>
                      @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                      @endforeach
                      </select>
                    </div>

                   </div>
                    </div>
                </div>
                
               
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Imágenes del producto</h4>
                  <input type="file" name='images[]' class="dropify" multiple/>
                </div>
              </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Registrar</button>
                     <a href="{{route('products.index')}}" class="btn btn-light">
                        Cancelar
                     </a>
            {!! Form::close() !!}
   
</div>
@endsection
@section('scripts')
{!! Html::script('melody/js/data-table.js') !!}
{!! Html::script('melody/js/dropify.js') !!}
{!! Html::script('select/dist/js/bootstrap-select.min.js') !!}
{!! Html::script('select2/dist/js/select2.min.js') !!}
{!! Html::script('ckeditor/ckeditor.js') !!}
<script>
   CKEDITOR.replace('long_description');
</script>
<script>
  $(document).ready(function(){
    $('#tags').select2();
  });
  </script>
<script src="melody/js/dropzone.js"></script>
@endsection
