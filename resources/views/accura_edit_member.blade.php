@extends('layouts.app')
@section('title', 'Accura Member Add')
@section('content')
    <div class="container">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Edit Member') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('update_member') }}">
                                @csrf

                                <div class="row">
                                    <div class="row col-12 col-md-6 mb-3">
                                        <input hidden name="id" value="{{$user[0]->id}}">
                                        <label for="email"
                                               class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                        <div class="col-md-8">
                                            <input id="first_name" type="text" class="form-control @error('first_name')
                                        is-invalid @enderror" name="first_name"
                                                   value="{{ old('first_name', $user[0]->first_name) }}" autofocus>

                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row col-12 col-md-6 mb-3">

                                        <label for="ds_division"
                                               class="col-md-4 col-form-label text-md-end">{{ __('DS Division') }}</label>

                                        <div class="col-md-8">

                                            <select value="{{$user[0]->division_id}}" class="form-select @error('ds_division')
                                        is-invalid @enderror" aria-label="Default select example" name="ds_division">
                                                @foreach($divisionList as $division)
                                                    <option value="{{$division->division_id}}">{{$division->name}}</option>
                                                @endforeach
                                            </select>

                                            @error('ds_division')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="row col-12 col-md-6 mb-3">
                                        <label for="last_name"
                                               class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                        <div class="col-md-8">
                                            <input id="last_name" type="text" class="form-control @error('last_name')
                                        is-invalid @enderror" name="last_name"
                                                   value="{{ old('last_name', $user[0]->last_name) }}" autofocus>

                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row col-12 col-md-6 mb-3">

                                        <label for="dob"
                                               class="col-md-4 col-form-label text-md-end">{{ __('Date of Birth') }}</label>

                                        <div class="col-md-8">
                                            <input id="dob" type="date" class="form-control @error('dob')
                                        is-invalid @enderror" name="dob"
                                                   value="{{ old('dob', $user[0]->dob) }}" autofocus>

                                            @error('dob')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="row col-12 col-md-6 mb-3">
                                        <label for="summary"
                                               class="col-md-4 col-form-label text-md-end">{{ __('Summary') }}</label>

                                        <div class="col-md-8">
                                            <textarea id="summary" type="text" class="form-control @error('summary')
                                        is-invalid @enderror" name="summary" autofocus value="{{$user[0]->summary}}"></textarea>

                                            @error('summary')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class=" mb-0">
                                    <div class="float-end">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Edit User') }}
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
