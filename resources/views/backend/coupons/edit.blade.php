@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Create Coupon</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.coupons.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class=" form-group">
                                <label for="code" class=" form-control-label">Coupon Code</label>
                                <input type="text" id="code"
                                    class="{{ $errors->has('code') ? 'is-invalid' : '' }} form-control" name="code"
                                    value="{{ old('code', isset($coupon) ? $coupon->code : '') }}">
                                @if ($errors->has('code'))
                                <span class="text-danger">{{ $errors->first('code') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="discount" class=" form-control-label">Discount</label>
                                <input type="number" id="discount"
                                    class="{{ $errors->has('discount') ? 'is-invalid' : '' }} form-control"
                                    name="discount" value="{{ old('discount', isset($coupon) ? $coupon->discount : '') }}">
                                @if ($errors->has('discount'))
                                <span class="text-danger">{{ $errors->first('discount') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="validate" class=" form-control-label">validate</label>
                                <input type="date" id="validate"
                                    class="{{ $errors->has('validate') ? 'is-invalid' : '' }} form-control"
                                    name="validate" value="{{ old('validate', isset($coupon) ? $coupon->validate : '') }}">
                                @if ($errors->has('validate'))
                                <span class="text-danger">{{ $errors->first('validate') }}</span>
                                @endif
                            </div>

                            <div class="form-actions form-group">
                                <button type="submit" class="btn btn-primary btn-md">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
@section('scripts_custom')

<script type="text/javascript">
    $(document).ready(function() {
        $( "#validate" ).datepicker();
  } );
</script>
@endsection
