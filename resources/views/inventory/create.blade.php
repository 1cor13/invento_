@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.inventory.title_singular') }}
                </div>

                <div class="card-body">
                    <form action="{{ route("inventory.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">                            
                            <label for="code">{{ trans('cruds.inventory.fields.code') }}</label>
                            <input type="text" id="code" name="code" class="form-control" }}" required>
                            @if($errors->has('code'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.inventory.fields.code_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('brand') ? 'has-error' : '' }}">
                            
                            <label for="brand">{{ trans('cruds.inventory.fields.brand') }}*</label>
                            <input type="text" id="brand" name="brand" class="form-control" required>
                            @if($errors->has('brand'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('brand') }}
                                </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.inventory.fields.brand_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('size') ? 'has-error' : '' }}">
                            
                            <label for="name">{{ trans('cruds.inventory.fields.size') }}*</label>
                            <input type="text" id="size" name="size" class="form-control" required>
                            @if($errors->has('size'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('size') }}
                                </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.inventory.fields.size_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                            
                            <label for="quantity">{{ trans('cruds.inventory.fields.quantity') }}*</label>
                            <input type="text" id="quantity" name="quantity" class="form-control" required>
                            @if($errors->has('quantity'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('quantity') }}
                                </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.inventory.fields.quantity_helper') }}
                            </p>
                        </div>

                        <div class="form-group {{ $errors->has('minimum_quantity') ? 'has-error' : '' }}">
                            <label for="minimum_quantity">{{ trans('cruds.inventory.fields.minimum_quantity') }}*</label>
                            <input type="text" id="minimum_quantity" name="minimum_quantity" class="form-control" required>
                            @if($errors->has('minimum_quantity'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('minimum_quantity') }}
                                </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.inventory.fields.minimum_quantity_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('saleable') ? 'has-error' : '' }}">
                            <label class="form-check-label" >
                                <input type="checkbox" id="saleable" name="saleable" class="switch_input" value="1">
                                Saleable
                            </label>
                          
                            @if($errors->has('saleable'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('saleable') }}
                                </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.inventory.fields.saleable_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">  
                            <label for="price">{{ trans('cruds.inventory.fields.price') }}*</label>
                            <input type="text" id="price" name="price" class="form-control" required>
                            @if($errors->has('price'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.inventory.fields.price_helper') }}
                            </p>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">                            
                            <label for="description">{{ trans('cruds.inventory.fields.description') }}</label>
                            <input type="text" id="description" name="description" class="form-control" }}" required>
                            @if($errors->has('description'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('cruds.inventory.fields.description_helper') }}
                            </p>
                        </div>
        
                        <div>
                            <input class="btn btn-primary" type="submit" value="Save">
                            <a href="{{ route('inventory.index') }}" class="btn btn-warning">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection