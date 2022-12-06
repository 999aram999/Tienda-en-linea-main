@extends('layouts.admin')
@section('title','Editar producto')
@section('styles')
{!! Html::style('melody/vendors/lightgallery/css/lightgallery.css') !!}
@endsection
@section('options')
@endsection
@section('preference')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            Edición de productos
        </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Panel administrador</a></li>
                <li class="breadcrumb-item"><a href="{{route('products.index')}}">Productos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edición de producto</li>
            </ol>
        </nav>
    </div>
    {!! Form::model($product,['route'=>['products.update',$product], 'method'=>'PUT','files' => true]) !!}
    <div class="row">
    
                <div class="col-md-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                      <div class="form-group">
                       <label for="name">Nombre</label>
                       <input type="text" name="name" value="{{  old('name', $product->name)}}" id="name" class="form-control @error('name') is-invalid @enderror" aria-describedby="helpId">
                       @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                
                       @enderror
                     </div>
                    <div class="form-group">
                      <label for="code">Código de barras</label>
                      <input type="text" name="code" value="{{  old('code', $product->code)}}" id="code" class="form-control @error('code') is-invalid @enderror">
                      @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                
                       @enderror
                     </div>
                     <div class="form-row">
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="sell_price">Precio Contado</label>
                                <input type="number" name="sell_price" value="{{  old('sell_price', $product->sell_price)}}" id="sell_price" class="form-control @error('sell_price') is-invalid @enderror"" aria-describedby="helpId">
                                @error('sell_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                
                       @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cred_price">Precio Crédito</label>
                                <input type="number" name="cred_price" value="{{  old('cred_price', $product->cred_price)}}" id="cred_price" class="form-control @error('cred_price') is-invalid @enderror" aria-describedby="helpId">
                                @error('cred_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                
                       @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                           <label for="stock">Stock</label>
                           <input type="number" name="stock" value="{{  old('stock', $product->stock)}}" id="stock" class="form-control @error('stock') is-invalid @enderror" aria-describedby="helpId">
                           @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                
                       @enderror
                           </div>
                        </div>
                    </div>

                   
                        <div class="form-group">
                          <label for="short_description">Extracto</label>
                          <textarea class="form-control @error('short_description') is-invalid @enderror" name="short_description" id="short_description " rows="3">
                          {{  old('short_description', $product->short_description)}}
                          </textarea>
                           @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                
                       @enderror
                          
                        </div>
                        <div class="form-group">
                          <label for="long_description">Descripción</label>
                          <textarea class="form-control  @error('long_description') is-invalid @enderror" name="long_description" id="long_description" rows="10">
                          {{  old('long_description', $product->long_description)}}
                          </textarea>
                           @error('long_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                
                       @enderror
                          
                        </div>
                    
   
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <div class="form-group">
                      <label for="category">Categoría</label>
                      <select class="form-control selectpicker  @error('category') is-invalid @enderror" data-live-search="true" id="category" name="category">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" 
                          {{old('category')}}
                        > {{$category->name}}</option>
                        @endforeach
                      </select>
                      @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                
                       @enderror
                    </div>
                     <div class="form-group">
                      <label for="subcategory_id">Subcategoría</label>
                      <select class="form-control selectpicker" data-live-search="true" name="subcategory_id" id="subcategory_id">
                        @foreach ($subcategories as $subcategory)
                        <option value="{{$subcategory->id}}" 
                        {{ old('subcategory_id', $product->subcategory_id) ==
                        $subcategory->id?'selected' : ''}}
                        > {{$subcategory->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="tags">Etiquetas</label>
                      <select class="select2" name="tags[]" id="tags" style="width: 100%" multiple>
                      @foreach($tags as $tag)
                        <option value="{{$tag->id}}" 
                        {{ collect(old('tags', $product->tags->pluck('id')))
                        ->contains($tag->id) ? 'selected' : ''}}
                        >{{$tag->name}}</option>
                      @endforeach
                      </select>
                    </div>
                  <div class="form-group">
                  <h4 class="card-title">Subir imágen</h4>
                  <div class="file-upload-wrapper">
                    <div id="fileuploader">Subir</div>
                  </div>
                  </div>
                   </div>
                    </div>
                </div>
                
               
            </div>
            <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Galería de imágenes</h4>
                  <div id="ligthgallery" class="row lightGallery">
                  @foreach ($product->images as $image)
                    <a href="{{$image->url}}" class="image-tile"><img src="{{$image->url}}" alt="image small"></a>
                  @endforeach
                  </div>
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
{!! Html::script('melody/js/dropify.js') !!}
{!! Html::script('ckeditor/ckeditor.js') !!}
{!! Html::script('melody/vendors/lightgallery/js/lightgallery-all.min.js') !!}
{!! Html::script('melody/js/light-gallery.js') !!}

<script>
  (function($){
    'use strict';
    if($("#fileuploader").length){
      $("#fileuploader").uploadFile({
        url:"/upload/product/{{$product->id}}/image",
        fileName: "image"
      });
    }
  })(jQuery);
</script>
<script>
   CKEDITOR.replace('long_description');
</script>
<script>
  $(document).ready(function(){
    $('#tags').select2();
  });
  </script>
  <script>
     var category = $('#category');
     var subcategory_id = $('#subcategory_id');
     category.change(function(){
      $.ajax({
        url: "{{route('get_subcategories')}}",
        method:'GET',
        data:{
          category: category.val(),
        },
        success: function(data){
          console.log(data);
          subcategory_id.empty();
          subcategory_id.append('<option disabled selected>-- Selecciona una subcategoría --</option>')
          $.each(data, function(index, element){
            subcategory_id.append('<option value="'+ element.id + '">' + element.name + '</option>' )
          });
        
        }
      });
     });
  </script>
@endsection
