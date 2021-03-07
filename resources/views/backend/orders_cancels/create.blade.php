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
                        <strong class="card-title">Create Book</strong>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.books.index') }}">Back</a>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <div class=" form-group">
                                        <label for="isbn" class=" form-control-label">ISBN No.</label>
                                        <input type="text" id="isbn"
                                            class="{{ $errors->has('isbn') ? 'is-invalid' : '' }} form-control"
                                            name="isbn" value="{{ old('isbn', isset($book) ? $book->isbn : '') }}">
                                        @if ($errors->has('isbn'))
                                        <span class="text-danger">{{ $errors->first('isbn') }}</span>
                                        @endif
                                    </div>
                                    <div class=" form-group">
                                        <label for="author_id" class=" form-control-label">Book Author</label>
                                        <select name="author_id" id="author_id" data-placeholder="Choose a Category..."
                                            class="standardSelect form-control {{ $errors->has('author_id') ? 'is-invalid' : '' }}"
                                            tabindex="1">
                                            @foreach ($authors as $author)
                                            <option value="{{$author->id}}">{{$author->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('author_id'))
                                        <span class="text-danger">{{ $errors->first('author_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class=" form-group">
                                        <label for="title" class=" form-control-label">Name</label>
                                        <input type="text" id="title"
                                            class="{{ $errors->has('title') ? 'is-invalid' : '' }} form-control"
                                            name="title" value="{{ old('title', isset($book) ? $book->title : '') }}">
                                        @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                    <div class=" form-group">
                                        <label for="title" class=" form-control-label">Categories</label>
                                        <select name="category[]" data-placeholder="Select Category" multiple=""
                                            class="form-control standardSelect {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                            tabindex="-1">
                                            @foreach ($categories as $category)
                                            <optgroup label="{{$category->title}}">
                                                @foreach ($category->subcategory as $subcat)
                                                <option value="{{$subcat->id }}">{{ $subcat->title  }}</option>
                                                @endforeach
                                            </optgroup>
                                            @endforeach

                                        </select>
                                        @if ($errors->has('category'))
                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label for="photo" class=" form-control-label">Photo</label>
                                        <input type="file" id="photo" name="photo"
                                            class="form-control-file {{ $errors->has('photo') ? 'is-invalid' : '' }}">
                                        @if ($errors->has('photo'))
                                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class=" form-group">
                                <label for="description" class=" form-control-label">Description</label>
                                <textarea name="description" id="description" rows="4" placeholder="Description..."
                                    class="form-control"></textarea>
                                @if ($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class=" form-group">
                                        <label for="price" class=" form-control-label">Price</label>
                                        <input type="text" id="price"
                                            class="{{ $errors->has('price') ? 'is-invalid' : '' }} form-control"
                                            name="price" value="{{ old('price', isset($book) ? $book->price : '') }}">
                                        @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                        @endif
                                    </div>
                                    <div class=" form-group">
                                        <label for="publisher_id" class=" form-control-label">Publisher</label>
                                        <select name="publisher_id" id="publisher_id"
                                            data-placeholder="Choose a Category..."
                                            class="standardSelect form-control {{ $errors->has('publisher_id') ? 'is-invalid' : '' }}"
                                            tabindex="1">
                                            @foreach ($publishers as $publisher)
                                            <option value="{{$publisher->id}}">{{$publisher->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('publisher_id'))
                                        <span class="text-danger">{{ $errors->first('publisher_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class=" form-group">
                                        <label for="discount" class=" form-control-label">Discount (%)</label>
                                        <input type="text" id="discount"
                                            class="{{ $errors->has('discount') ? 'is-invalid' : '' }} form-control"
                                            name="discount"
                                            value="{{ old('discount', isset($book) ? $book->discount : '') }}">
                                        @if ($errors->has('discount'))
                                        <span class="text-danger">{{ $errors->first('discount') }}</span>
                                        @endif
                                    </div>
                                    <div class=" form-group">
                                        <label for="edition" class=" form-control-label">Edition</label>
                                        <input type="text" id="edition"
                                            class="{{ $errors->has('edition') ? 'is-invalid' : '' }} form-control"
                                            name="edition"
                                            value="{{ old('edition', isset($book) ? $book->edition : '') }}">
                                        @if ($errors->has('edition'))
                                        <span class="text-danger">{{ $errors->first('edition') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class=" form-group">
                                        <label for="quantity" class=" form-control-label">Quantity</label>
                                        <input type="text" id="quantity"
                                            class="{{ $errors->has('quantity') ? 'is-invalid' : '' }} form-control"
                                            name="quantity"
                                            value="{{ old('quantity', isset($book) ? $book->quantity : '') }}">
                                        @if ($errors->has('quantity'))
                                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                        @endif
                                    </div>
                                    <div class=" form-group">
                                        <label for="language" class=" form-control-label">Language</label>
                                        <input type="text" id="language"
                                            class="{{ $errors->has('language') ? 'is-invalid' : '' }} form-control"
                                            name="language"
                                            value="{{ old('language', isset($book) ? $book->language : '') }}">
                                        @if ($errors->has('language'))
                                        <span class="text-danger">{{ $errors->first('language') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

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
