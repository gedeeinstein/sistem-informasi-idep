<script>
    $(document).ready(function(){
        $('.select2').select2({
            placeholder: "{{ trans('global.pleaseSelect')}}",
            allowClear: true,
        });
        $(document).on('click', '#show-aktif, [id^="aktif_"]', function(e) {
            e.preventDefault(); //not allow user to click the checkbox for aktif checbox
        });

        // LOAD DATA USERS with ROLES into DATATABLES
        $('#users_list').DataTable({
            ajax: {
                    "url": "{{ route('users.api') }}",
                    "type": "GET",
                    "dataType": "JSON",
            },
            responsive: true,lengthChange: false,
            processing: true,autoWidth: false,serverSide: true,deferRender: true, stateSave: true,
            rowCallback: function(row, data, index) {
                if (index % 2 === 0) {
                    $(row).addClass('even');
                } else {
                    $(row).addClass('odd');
                }
            },
            columns: [
                {data: "nama", width: "15%", className: "text-left"},
                {data: "username",width: "15%",className: "text-left"},
                {data: "email",width: "15%",className: "text-left"},
                {data: "roles", name: "roles.nama", width: "15%", className: "text-left", searchable: true, orderable: false,}, //added name:"roles.name" to get eager relation of users to roles
                {data: "status",width: "5%", className: "text-center", orderable: false, searchable: false,}, //change column aktif into status by adding ->addColumn in Controller that send DataTables
                {data: "action", width: "10%", orderable: false, searchable: false}
            ],
            layout: {
                topStart: {
                    buttons: [
                        {extend: 'print',exportOptions: {columns: [0, 1, 2, 3]}},// Ensure these indices match your visible columns
                        {extend: 'excel',exportOptions: {columns: [0, 1, 2, 3]}},
                        {extend: 'pdf',exportOptions: {columns: [0, 1, 2, 3]}},
                        {extend: 'copy',exportOptions: {columns: [0, 1, 2, 3]}},
                        'colvis',
                    ],
                },
                bottomStart: {
                    pageLength: 5,
                }
            },
            order: [
                [2, 'asc'] // Ensure this matches the index of the `users` column
            ],
            lengthMenu: [5, 10 ,25, 50, 100, 200],
        });


        //CALL VIEW MODAL FOR USERS
        $('#users_list tbody').on('click', '.edit-user-btn, .view-user-btn', function (e){
            e.preventDefault();
            let action    = $(this).data('action');
            let id_users  = $(this).data('user-id');
            let url_show  = '{{ route('users.showmodal', ':id') }}'.replace(':id',id_users);
            let url_edit  = '{{ route('users.edit', ':id') }}'.replace(':id',id_users);
            let url_update  = '{{ route('users.update', ':id') }}'.replace(':id',id_users);

            // if button view clicked
            if(action === "view"){
                $.ajax({
                    url: url_show,
                    method: 'GET',
                    dataType: 'json',
                    beforeSend: function(){
                        Toast.fire({icon: "info",title: "Processing...",timer: 500,timerProgressBar: true,});
                    },
                    success: function(data) {
                        $('#view_nama').text(data.nama);
                        $('#view_username').text(data.username);
                        $('#view_email').text(data.email);
                        // $('#view_jabatan').text(data.jabatan.nama); //use to display jabatan if jabatan modul finish
                        $('#view_roles').empty();
                        data.roles.forEach(role => {
                            $('#view_roles').append(`<span class="btn-xs bg-warning">${role.nama}</span> `);
                        });
                        if (data.aktif === 1) {
                            $('#aktif_show').val(data.aktif);
                            $("#aktif_show").prop("checked",true);
                        } else {
                            $('#aktif_show').val(0);
                            $("#aktif_show").prop("checked",false);
                        }
                        $('#status').text(data.aktif === 1? "{{ __('cruds.status.aktif') }}" : "{{ __('cruds.status.tidak_aktif') }}");
                        $('#showUsersModal .modal-title').text(data.nama);
                        $('#showUsersModal').modal('show');
                    }
                });
            }
            // if button edit clicked
            if(action === "edit"){
                $.ajax({
                    url: url_edit,
                    method: 'GET',
                    dataType: 'JSON',
                    beforeSend: function(){
                        Toast.fire({icon: "info", title: "Processing...",timer: 500, timerProgressBar: true,});
                    },
                    success: function(data) {
                        $('#AddUserForm').trigger('reset');
                        $('#AddUserForm').attr('action', url_update);
                        $('#id_user').val(data.id);
                        $('#edit_nama').val(data.nama);
                        $('#edit_username').val(data.username);
                        if (data.username === '' || data.username === null) {
                            $('#edit_username').prop('disabled', false);
                        } else {
                            $('#edit_username').prop('disabled', true);
                        }
                        $('#edit_email').val(data.email);
                        $('#edit_password').val('');
                        $('#edit_password_confirmation').val('');

                        var selectedRoles = data.roles.map(function(role) {
                            return role.id;
                        });
                        $('#edit_roles').val(selectedRoles).trigger('change');

                        $('#edit_aktif').prop('checked', data.aktif == 1);
                        $('#status').text(data.aktif == 1 ? 'Active' : 'Not Active');
                        // $('#edit_jabatan').val(data.jabatan.nama || '');
                        $('#EditUsersModal .modal-title').text("Edit Data" +data.nama);
                        $('#EditUsersModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = `Error: ${xhr.status} - ${xhr.statusText}`;
                        try {
                            const response = xhr.responseJSON;
                            if (response.errors) {
                                errorMessage += '<br><br><ul style="text-align:left!important">';
                                $.each(response.errors, function(field, messages) {
                                    messages.forEach(message => {
                                        errorMessage += `<li>${field}: ${message}</li>`;
                                        $(`#${field}-error`).removeClass('is-valid').addClass('is-invalid');
                                        $(`#${field}-error`).text(message);
                                        $(`#${field}`).removeClass('invalid').addClass('is-invalid');
                                    });
                                });
                                errorMessage += '</ul>';
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    html: errorMessage,
                                });
                            }

                            if (response.message) {
                                errorMessage = response.message;
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    html: errorMessage,
                                });
                            }
                        } catch (e) {
                            console.error('Error parsing response:', e);
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: errorMessage,
                        });
                    }
                });
            }
        });

        //ADD USER FORM
        $('#AddUserForm').on('submit', function(e){
            e.preventDefault();
            if (!$(this).valid()) {
                return;
            }
            let formData = $(this).serialize();
            let url = $(this).attr('action');
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                dataType: 'json',
                beforeSend: function(){
                    Toast.fire({icon: "info", title: "Processing...",timer: 500, timerProgressBar: true,});
                },
                success: function(response) {
                    if(response.success){
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: "success",
                            timer: 1500,
                            timerProgressBar: true,
                            didOpen: ()=>{
                                Swal.showLoading();
                            },
                        });
                        $('#AddUserForm')[0].reset();
                        $('#AddUserForm').trigger('reset');
                        $(this).trigger('reset');
                        $(".btn-tool").trigger('click');
                        $('#users_list').DataTable().ajax.reload();
                        $('#AddUserModal').modal('hide');
                        $('#roles').val(null).trigger('change');
                    }else{
                        Toast.fire({icon: "error", title: response.message});
                    }
                }
            });
        });

        //UPDATE USER BUTTON CLICKED
        $('#EditUserForm').on('submit', function(e){
            e.preventDefault();

            if (!$(this).valid()) {
                return;
            }
            Swal.fire({
                title: "Are you sure?",
                text: "You want to update this user?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            })
        })


        //VALIDATE FORM
        $(function(){
            const AddUserValidator = $("#AddUserForm").validate({
                rules: {
                    nama: { required: true, maxlength: 100, minlength: 5},
                    username: {
                        required: true, maxlength: 50, minlength: 5 ,
                        remote: {
                            url: "{{ route('check.username') }}", // Laravel route
                            type: "get",
                            dataType: 'json',
                            data: {
                                _token: "{{ csrf_token() }}",
                                username: function() {
                                    return $('#username').val();
                                }
                            },
                            delay: 3000,
                        }
                    },
                    email: {
                        required: true, email: true, maxlength: 100,
                        remote: {
                            url: "{{ route('check.email') }}", // Laravel route
                            type: "get",
                            dataType: 'json',
                            data: {
                                _token: "{{ csrf_token() }}",
                                email: function() {
                                    return $('#email').val();
                                }
                            },
                            delay: 3000 ,
                        }
                    },
                    password: { required: true, maxlength: 100 },
                    'roles[]': {
                        required: true,
                        },
                    password_confirmation: {required: true, equalTo: "#password"},
                },
                messages: {
                    nama: {
                        required: "Nama is required",
                        maxlength: "Nama cannot be more than 100 characters"
                    },
                    username: {
                        required: "Username is required",
                        minlength: "Username minimum length must be at least 5 characters",
                        maxlength: "Username cannot be more than 50 characters",
                        remote: "Username already in use"
                    },
                    email: {
                        required: "Email is required",
                        email: "Please enter a valid email address",
                        maxlength: "Email cannot be more than 100 characters",
                        remote: "Email already in use"
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password minimal 8 characters",
                        maxlength: "Password cannot be more than 100 characters"
                    },
                    password_confirmation: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    },
                    'roles[]': {
                        required: "At least one role is required",
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                showErrors: function(errorMap, errorList) {
                    this.defaultShowErrors(); // Call the default showErrors first
                    if (errorList.length) {
                        $.each(errorList, function(index, error) {
                            const field = error.element.id;
                            const message = error.message;
                            $(`#${field}-error`).removeClass('is-valid').addClass('is-invalid');
                            $(`#${field}-error`).text(message);
                            $(`#${field}`).removeClass('is-valid').addClass('is-invalid');
                        });
                    } else {
                        $("#error-summary").remove();
                    }
                },
                // submitHandler: function(form) {
                //     AddUserForm()
                // }
            });

            const EditUserValidator = $("#EditUserForm").validate({
                rules: {
                    nama: { required: true, maxlength: 100, minlength: 5},
                    username: {
                        required: true, maxlength: 50, minlength: 5 ,
                        remote: {
                            url: "{{ route('check.username') }}", // Laravel route
                            type: "get",
                            dataType: 'json',
                            data: {
                                _token: "{{ csrf_token() }}",
                                username: function() {
                                    return $('#edit_username').val();
                                }
                            },
                            delay: 3000,
                        }
                    },
                    email: {
                        required: true, email: true, maxlength: 100,
                        remote: {
                            url: "{{ route('check.email') }}", // Laravel route
                            type: "get",
                            dataType: 'json',
                            data: {
                                _token: "{{ csrf_token() }}",
                                email: function() {
                                    return $('#edit_email').val();
                                },
                                id: function() {
                                    return $('#id_user').val();
                                }
                            },
                            delay: 3000 ,
                        }
                    },
                    password: { required: false, maxlength: 100 },
                    'roles[]': {
                        required: true,
                        },
                    password_confirmation: {required: false, equalTo: "#password"},
                },
                messages: {
                    nama: {
                        required: "Nama is required",
                        maxlength: "Nama cannot be more than 100 characters"
                    },
                    username: {
                        required: "Username is required",
                        minlength: "Username minimum length must be at least 5 characters",
                        maxlength: "Username cannot be more than 50 characters",
                        remote: "Username already in use"
                    },
                    email: {
                        required: "Email is required",
                        email: "Please enter a valid email address",
                        maxlength: "Email cannot be more than 100 characters",
                        remote: "Email already in use"
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password minimal 8 characters",
                        maxlength: "Password cannot be more than 100 characters"
                    },
                    password_confirmation: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    },
                    'roles[]': {
                        required: "At least one role is required",
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                showErrors: function(errorMap, errorList) {
                    this.defaultShowErrors(); // Call the default showErrors first
                    if (errorList.length) {
                        $.each(errorList, function(index, error) {
                            const field = error.element.id;
                            const message = error.message;
                            $(`#${field}-error`).removeClass('is-valid').addClass('is-invalid');
                            $(`#${field}-error`).text(message);
                            $(`#${field}`).removeClass('is-valid').addClass('is-invalid');
                        });
                    } else {
                        $("#error-summary").remove();
                    }
                },
            });
        });

    });
</script>
