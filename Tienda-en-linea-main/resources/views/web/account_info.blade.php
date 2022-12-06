@extends('web.my_account')
@section('content_tab')

<div class="col-lg-9 col-md-8">

    <!-- Single Tab Content Start -->
    <!-- <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Billing Address</h3>
                                                <address>
                                                    <p><strong>Alex Tuntuni</strong></p>
                                                    <p>1355 Market St, Suite 900 <br>
                                                        San Francisco, CA 94103</p>
                                                    <p>Mobile: (123) 456-7890</p>
                                                </address>
                                                <a href="#" class="check-btn sqr-btn "><i class="fa fa-edit"></i> Edit Address</a>
                                            </div>
                                        </div> -->
    <!-- Single Tab Content End -->

    <!-- Single Tab Content Start -->
    <div class="myaccount-content">
        <h3>Account Details</h3>
        <div class="account-details-form">
            {!! Form::model($user,['route'=>['web.update_client',$user], 'method'=>'PUT']) !!}
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-input-item">
                        <label for="name" class="required">Nombre</label>
                        <input type="text" id="name" name="name" value="{{$user->name}}" placeholder="Nombre" required /><!--old('ruc',-->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-input-item">
                        <label for="surnames" class="required">Apellido</label>
                        <input type="text" id="surnames" name="surnames" value="{{$user->surnames}}" placeholder="Apellido" required />
                    </div>
                </div>
            </div>
            <div class="single-input-item">
                <label for="email" class="required">Correo electrónico</label>
                <input type="email" id="email" name="email" value="{{$user->email}}" placeholder="Correo electrónico" required />
            </div>
            <div class="single-input-item">
                <button class="check-btn sqr-btn ">Guardar cambios</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection