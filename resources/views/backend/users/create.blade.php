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
                        <strong class="card-title">Create User</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.users.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class=" form-group">
                                <label for="name" class=" form-control-label">Name</label>
                                <input type="text" id="name"
                                    class="{{ $errors->has('name') ? 'is-invalid' : '' }} form-control" name="name"
                                    value="{{ old('name', isset($user) ? $user->name : '') }}">
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="email" class=" form-control-label">Email</label>
                                <input type="email" id="email"
                                    class="{{ $errors->has('email') ? 'is-invalid' : '' }} form-control" name="email"
                                    value="{{ old('email', isset($user) ? $user->email : '') }}">
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="password" class=" form-control-label">Password</label>
                                <input type="password" id="password"
                                    class="{{ $errors->has('password') ? 'is-invalid' : '' }} form-control"
                                    name="password"
                                    value="{{ old('password', isset($user) ? $user->password : '') }}">
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="roles" class="form-control-label">Roles</label>
                                <select id="roles" name="roles[]" data-placeholder="Choose a role..."
                                    multiple class="standardSelect"
                                    class="{{ $errors->has('roles') ? 'is-invalid' : '' }} form-control">
                                    @foreach($roles as $id => $roles)
                                    <option value="{{ $id }}"
                                        {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>
                                        {{ $roles }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('roles'))
                                <span class="text-danger">{{ $errors->first('roles') }}</span>
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
