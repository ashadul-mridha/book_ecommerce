@extends('layouts.backend')


@section('content')
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <strong class="card-title">Update Search Section</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.searchs.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.searchs.update', $search->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class=" form-group">
                                <label for="categorie_icon" class=" form-control-label">Categories Icon Class
                                    Name</label>
                                <input type="text" id="categorie_icon"
                                    class="{{ $errors->has('categorie_icon') ? 'is-invalid' : '' }} form-control"
                                    name="categorie_icon"
                                    value="{{ old('categorie_icon', isset($search) ? $search->categorie_icon : '') }}">
                                @if ($errors->has('categorie_icon'))
                                <span class="text-danger">{{ $errors->first('categorie_icon') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="categorie_name" class=" form-control-label">Categories Name</label>
                                <input type="text" id="categorie_name"
                                    class="{{ $errors->has('categorie_name') ? 'is-invalid' : '' }} form-control"
                                    name="categorie_name"
                                    value="{{ old('categorie_name', isset($search) ? $search->categorie_name : '') }}">
                                @if ($errors->has('categorie_name'))
                                <span class="text-danger">{{ $errors->first('categorie_name') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="search_placeholder" class=" form-control-label">Search Placeholder</label>
                                <input type="text" id="search_placeholder"
                                    class="{{ $errors->has('search_placeholder') ? 'is-invalid' : '' }} form-control"
                                    name="search_placeholder"
                                    value="{{ old('search_placeholder', isset($search) ? $search->search_placeholder : '') }}">
                                @if ($errors->has('search_placeholder'))
                                <span class="text-danger">{{ $errors->first('search_placeholder') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="search_icon" class=" form-control-label">Search Icon Class Name</label>
                                <input type="text" id="search_icon"
                                    class="{{ $errors->has('search_icon') ? 'is-invalid' : '' }} form-control"
                                    name="search_icon"
                                    value="{{ old('search_icon', isset($search) ? $search->search_icon : '') }}">
                                @if ($errors->has('search_icon'))
                                <span class="text-danger">{{ $errors->first('search_icon') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="offer_name" class=" form-control-label">Offer Title</label>
                                <input type="text" id="offer_name"
                                    class="{{ $errors->has('offer_name') ? 'is-invalid' : '' }} form-control"
                                    name="offer_name"
                                    value="{{ old('offer_name', isset($search) ? $search->offer_name : '') }}">
                                @if ($errors->has('offer_name'))
                                <span class="text-danger">{{ $errors->first('offer_name') }}</span>
                                @endif
                            </div>
                            <div class=" form-group">
                                <label for="offer_second_name" class=" form-control-label">Offer Second Title</label>
                                <input type="text" id="offer_second_name"
                                    class="{{ $errors->has('offer_second_name') ? 'is-invalid' : '' }} form-control"
                                    name="offer_second_name"
                                    value="{{ old('offer_second_name', isset($search) ? $search->offer_second_name : '') }}">
                                @if ($errors->has('offer_second_name'))
                                <span class="text-danger">{{ $errors->first('offer_second_name') }}</span>
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
