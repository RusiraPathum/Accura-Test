
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
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
                data:{"_token": "{{ csrf_token() }}",},
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
