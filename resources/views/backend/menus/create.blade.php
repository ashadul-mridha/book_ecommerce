@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Create Menu</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.menus.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class=" form-group">
                                <label for="item_one" class=" form-control-label">Item one Name</label>
                                <input type="text" id="item_one"
                                    class="{{ $errors->has('item_one') ? 'is-invalid' : '' }} form-control"
                                    name="item_one"
                                    value="{{ old('item_one', isset($menu) ? $menu->item_one : '') }}">
                                @if ($errors->has('item_one'))
                                <span class="text-danger">{{ $errors->first('item_one') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="item_two" class=" form-control-label">Item two Name</label>
                                <input type="text" id="item_two"
                                    class="{{ $errors->has('item_two') ? 'is-invalid' : '' }} form-control"
                                    name="item_two"
                                    value="{{ old('item_two', isset($menu) ? $menu->item_two : '') }}">
                                @if ($errors->has('item_two'))
                                <span class="text-danger">{{ $errors->first('item_two') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="item_three" class=" form-control-label">Item three Name</label>
                                <input type="text" id="item_three"
                                    class="{{ $errors->has('item_three') ? 'is-invalid' : '' }} form-control"
                                    name="item_three"
                                    value="{{ old('item_three', isset($menu) ? $menu->item_three : '') }}">
                                @if ($errors->has('item_three'))
                                <span class="text-danger">{{ $errors->first('item_three') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="item_four" class=" form-control-label">Item four Name</label>
                                <input type="text" id="item_four"
                                    class="{{ $errors->has('item_four') ? 'is-invalid' : '' }} form-control"
                                    name="item_four"
                                    value="{{ old('item_four', isset($menu) ? $menu->item_four : '') }}">
                                @if ($errors->has('item_four'))
                                <span class="text-danger">{{ $errors->first('item_four') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="item_five" class=" form-control-label">Item five Name</label>
                                <input type="text" id="item_five"
                                    class="{{ $errors->has('item_five') ? 'is-invalid' : '' }} form-control"
                                    name="item_five"
                                    value="{{ old('item_five', isset($menu) ? $menu->item_five : '') }}">
                                @if ($errors->has('item_five'))
                                <span class="text-danger">{{ $errors->first('item_five') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="item_six" class=" form-control-label">Item six Name</label>
                                <input type="text" id="item_six"
                                    class="{{ $errors->has('item_six') ? 'is-invalid' : '' }} form-control"
                                    name="item_six"
                                    value="{{ old('item_six', isset($menu) ? $menu->item_six : '') }}">
                                @if ($errors->has('item_six'))
                                <span class="text-danger">{{ $errors->first('item_six') }}</span>
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
