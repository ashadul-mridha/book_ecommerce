@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Create User</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.headers.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.headers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row form-group ">
                                <div class="col col-md-3"><label for="logo" class=" form-control-label">Logo</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="file" id="logo" name="logo"
                                        class="form-control-file {{ $errors->has('logo') ? 'is-invalid' : '' }}">
                                    @if ($errors->has('logo'))
                                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                                    @endif
                                </div>

                            </div>
                            <div class=" form-group">
                                <label for="cart_icon" class=" form-control-label">Cart icon Class Name</label>
                                <input type="text" id="cart_icon"
                                    class="{{ $errors->has('cart_icon') ? 'is-invalid' : '' }} form-control"
                                    name="cart_icon"
                                    value="{{ old('cart_icon', isset($header) ? $header->cart_icon : '') }}">
                                @if ($errors->has('cart_icon'))
                                <span class="text-danger">{{ $errors->first('cart_icon') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="contact_icon" class=" form-control-label">Contact Icon Class Name</label>
                                <input type="text" id="contact_icon"
                                    class="{{ $errors->has('contact_icon') ? 'is-invalid' : '' }} form-control"
                                    name="contact_icon"
                                    value="{{ old('contact_icon', isset($header) ? $header->contact_icon : '') }}">
                                @if ($errors->has('contact_icon'))
                                <span class="text-danger">{{ $errors->first('contact_icon') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="contact_number" class=" form-control-label">Contact Number</label>
                                <input type="text" id="contact_number"
                                    class="{{ $errors->has('contact_number') ? 'is-invalid' : '' }} form-control"
                                    name="contact_number"
                                    value="{{ old('contact_number', isset($header) ? $header->contact_number : '') }}">
                                @if ($errors->has('contact_number'))
                                <span class="text-danger">{{ $errors->first('contact_number') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="button_name" class=" form-control-label">Button Name</label>
                                <input type="text" id="button_name"
                                    class="{{ $errors->has('button_name') ? 'is-invalid' : '' }} form-control"
                                    name="button_name"
                                    value="{{ old('button_name', isset($header) ? $header->button_name : '') }}">
                                @if ($errors->has('button_name'))
                                <span class="text-danger">{{ $errors->first('button_name') }}</span>
                                @endif
                            </div>

                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-md">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection


