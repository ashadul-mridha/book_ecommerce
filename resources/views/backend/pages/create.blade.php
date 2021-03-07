@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Create Ads</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.pages.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group ">
                                <label for="title" class=" form-control-label">Titel</label>

                                <input type="text" id="title" name="title"
                                    class="form-control-file {{ $errors->has('title') ? 'is-invalid' : '' }}">
                                @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif

                            </div>
                            <div class="form-group ">
                                <label for="content" class=" form-control-label">Content</label>
                                <textarea name="content" id="content" rows="4" placeholder="Description..."
                                class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"></textarea>
                                
                                @if ($errors->has('content'))
                                <span class="text-danger">{{ $errors->first('content') }}</span>
                                @endif

                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Status</label>

                                <div class="form-check">
                                    <div class="checkbox">
                                        <label for="status" class="form-check-label ">
                                            <input type="checkbox" id="status" name="status" value="on"
                                                class="form-check-input">Publish
                                        </label>
                                    </div>
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
<script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');

</script>
@endsection
