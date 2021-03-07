@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="{{asset('backend/assets/css/lib/chosen/chosen.min.css')}}">
@endsection
@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Create Role</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.roles.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class=" form-group">
                                <label for="name" class=" form-control-label">Title</label>
                                <input type="text" id="name"
                                    class="{{ $errors->has('name') ? 'is-invalid' : '' }} form-control"
                                    name="name">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="permission" class=" form-control-label">Permissions</label>
                                <select id="permission" name="permission[]" data-placeholder="Choose a permission..." multiple
                                    class="standardSelect">
                                    @foreach($permissions as $id => $permissions)
                                    <option value="{{ $id }}"
                                        {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>
                                        {{ $permissions }}</option>
                                    @endforeach
                                </select>
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
@section('scripts')
<script src="{{asset('backend/assets/js/lib/chosen/chosen.jquery.min.js')}}"></script>
@endsection
@section('scripts_custom')
<script>
    jQuery(document).ready(function() {
        jQuery(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });
    });
</script>
@endsection
