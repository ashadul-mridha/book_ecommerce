@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Create Menu</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.second.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.second.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
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
                            <div class="row  form-group quick_link">
                                <div class="col col-md-3 align-self-center">
                                    <label for="name" class=" form-control-label">Item</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    Name: <input type="text" id="name"
                                        class="{{ $errors->has('name.*') ? 'is-invalid' : '' }} form-control mb-2"
                                        name="name[]">
                                    @if ($errors->has('name.*'))
                                    <span class="text-danger d-block">{{ $errors->first('name.*') }}</span>
                                    @endif
                                    Link: <input type="text" id="link"
                                        class="{{ $errors->has('link.*') ? 'is-invalid' : '' }} form-control"
                                        name="link[]">
                                    @if ($errors->has('link.*'))
                                    <span class="text-danger d-block">{{ $errors->first('link.*') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-9 offset-md-3">
                                    <button type="button" id="add_item" class="btn btn-info btn-sm mt-2">Add
                                        New</button>
                                </div>
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
@section('scripts_custom')
<script type="text/javascript">
    (function ($) {
    "use strict";
    $(document).on('click', '#add_item', function() {
        $('.quick_link:first').clone().insertAfter(".quick_link:last").find('.col-md-9').append('<button type="button" class=" delete_item btn btn-danger btn-sm mt-2">Delete</button>');
    }).on('click', '.delete_item', function() {
        $(this).closest('.quick_link').remove();
    });

})(jQuery);
</script>
@endsection
