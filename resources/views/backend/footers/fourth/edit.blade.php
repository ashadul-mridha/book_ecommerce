@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Update Footer Fourth Cloumn</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.fourth.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.fourth.update', $footer->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row form-group">
                                <div class="col-12 col-md-3">
                                    <label for="title" class=" form-control-label">Heading</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="title"
                                    class="{{ $errors->has('title') ? 'is-invalid' : '' }} form-control" name="title"
                                    value="{{ old('title', isset($footer) ? $footer->title : '') }}">
                                @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                                </div>
                            </div>
                            @php
                            $name = explode("|", $footer->name);
                            $link = explode("|", $footer->link);
                            $data = array_combine($name, $link);
                            @endphp
                            @foreach ($data as $key => $value)
                            <div class="row  form-group company">
                                <div class="col col-md-3 align-self-center">
                                    <label for="name" class=" form-control-label">Item</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    Name: <input type="text" id="name"
                                        class="{{ $errors->has('name.*') ? 'is-invalid' : '' }} form-control mb-2"
                                        name="name[]"
                                        value="{{ old('name', isset($key) ? $key : '') }}">
                                    @if ($errors->has('name.*'))
                                    <span class="text-danger d-block">{{ $errors->first('name.*') }}</span>
                                    @endif
                                    Link: <input type="text" id="link"
                                        class="{{ $errors->has('link.*') ? 'is-invalid' : '' }} form-control"
                                        name="link[]"
                                        value="{{ old('link', isset($value) ? $value : '') }}">
                                    @if ($errors->has('link.*'))
                                    <span class="text-danger d-block">{{ $errors->first('link.*') }}</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-12 col-md-9 offset-md-3">
                                    <button type="button" id="add_item" class="btn btn-info btn-sm mt-2">Add
                                        New</button>
                                </div>
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
    (function ($) {
    "use strict";
    $('.company').not(":first").find('.col-md-9').append('<button type="button" class=" delete_item btn btn-danger btn-sm mt-2">Delete</button>');
    $(document).on('click', '#add_item', function() {
        $('.company:first').clone().insertAfter(".company:last").find('.col-md-9').append('<button type="button" class=" delete_item btn btn-danger btn-sm mt-2">Delete</button>');
    }).on('click', '.delete_item', function() {
        $(this).closest('.company').remove();
    });

})(jQuery);
</script>
@endsection
