@extends('layouts.app')
@section('title', 'Accura Member List')
@section('content')
    <div class="container">

        <div class="container">
            <h2 class="text-center mt-5">Member List</h2>
            <div class="row mt-5">
                <div class="col-6">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input class="form-control border-end-0 border rounded-pill" type="search" value="search"
                                   id="example-search-input">
                            <span class="input-group-append">
                                <button class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <a class="btn btn-info float-end" href="{{ url('/accura_add_member') }}">Add New Member</a>
                </div>
            </div>

            <div class="row mt-5">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">DS Division</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row justify-content-center">

        </div>
    </div>
@endsection
