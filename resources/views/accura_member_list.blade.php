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
                        <th scope="col" class="float-end">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($userList) > 0)
                        @foreach($userList as $user)
                            <tr>
                                <th scope="row">{{$user->first_name}}</th>
                                <td>{{$user->last_name .' '. $user->summary}}</td>
                                <td>{{$user->dob}}</td>
                                <td>{{$user->name}}</td>
                                <td class="float-end">
                                <td>
                                    <a class="btn btn-success" href="{{ url('userEdit/'.$user->id) }}">Edit</a>
                                    <input type="button" onclick="deleteUser({{$user->id}});" class="btn btn-danger mr-3" value="Delete">
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    @if(count($userList) == 0)
                            <tr class="text-danger">
                                <td>No data</td>
                            </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row justify-content-center">

        </div>
    </div>

    {{--edit user modal--}}

    <div class="modal fade" id="edit_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <form id="editUserForm">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input hidden type="text" name="id"id="id">
                                    <div class="form-group col-12">
                                        <label for="first_name">Add first name</label>
                                        <input type="text" name="first_name" class="form-control" id="first_name"
                                               placeholder="Add first name.">
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="last_name">Add last name</label>
                                        <input class="form-control"  placeholder="Add last name" type="text" name="last_name" id="last_name">
                                    </div>

                                    <div class="form-group col-lg-12 col-12">
                                        <label for="ds_division">Select DS Division </label>
                                        <select id="ds_division" name="ds_division"
                                                class="form-control required">
                                            <option value="">select one</option>
                                            @foreach($divisionList as $division)
                                                <option value="{{$division->id}}">{{$division->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="dob">Add Date of Birth</label>
                                        <input type="date" name="dob" class="form-control"
                                                  id="dob">
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="summary">Add summary</label>
                                        <textarea type="text" name="summary" class="form-control"
                                                  id="summary" placeholder="Add summary"></textarea>
                                    </div>


                                </div>

                                <div class="mt-3">
                                    <button type="button" id="edit_user" class="btn btn-success">Edit User</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('import_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function setUserDetails(id, first_name, last_name, dob, ds_division, name, summary, ) {

            document.getElementById('id').value = id;
            document.getElementById('first_name').value = first_name;
            document.getElementById('last_name').value = last_name;
            document.getElementById('dob').value = dob;
            document.getElementById('ds_division').value = ds_division;
            document.getElementById('summary').value = summary;
        }

        $( "#edit_user" ).click(function() {
            var update_id = document.getElementById('id').value;
            var update_first_name = document.getElementById('first_name').value;
            var update_last_names = document.getElementById('last_name').value;
            var update_dob = document.getElementById('dob').value;
            var update_ds_division = document.getElementById('ds_division').value;
            var update_summary = document.getElementById('summary').value;

            var formData = {
                update_id: update_id,
                update_first_name: update_first_name,
                update_last_names: update_last_names,
                update_dob: update_dob,
                update_ds_division: update_ds_division,
                update_summary: update_summary,
            }

            $.ajax({
                type: 'POST',
                url: "/user_edit",
                data: formData,
                beforeSend: function () {
                    $("#edit_user").prop("disabled", true);
                    // add spinner to button
                    $("#edit_user").html(
                        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                    );
                },
                success: (response) => {
                    console.log(response);
                    // if (response == 1) {
                    //     Swal.fire({
                    //         position: 'top-end',
                    //         icon: 'success',
                    //         title: 'User has been Updated',
                    //         showConfirmButton: false,
                    //         timer: 1500
                    //     })
                    //     $('#editUserForm')[0].reset();
                    //     $("#edit_user_modal").hide();
                    //     $('.modal-backdrop').hide();
                    //
                    //     // setTimeout(function () {
                    //     //     location.reload();
                    //     // }, 1000);
                    //
                    // } else {
                    //     Swal.fire({
                    //         icon: 'error',
                    //         title: 'Oops...',
                    //         text: 'User has not been Updated!'
                    //     })
                    // }
                },

            });

        });

        function deleteUser(userId) {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'POST',
                        url: "/delete_user/" + userId,
                        data:{"_token": "{{ csrf_token() }}"},
                        success: (response) => {
                            if (response == 1) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'User has been Deleted',
                                    showConfirmButton: false,
                                    timer: 1500
                                })

                                location.reload();

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'User has not been deleted!'
                                })
                            }
                        },
                        error: function (request, error) {
                            console.log("Request: " + JSON.stringify(error));
                        }

                    });

                }
            })

        }

    </script>
