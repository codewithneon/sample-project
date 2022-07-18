@extends('layouts.app')
@section('body')
    <div class="container-fluid">
        <div class="row p-5">
            <div class="card col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Meta Name</th>
                        <th width="180">
                            <a type="button"
                               href="#formDialog"
                               data-toggle="modal"
                               class="btn btn-block btn-sm btn-success">
                                <span class="mdi mdi-account-plus"></span>
                                <span> CREATE </span>
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->mobile}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <span class="mdi mdi-information" title="{{$user->meta->description}}"></span>
                                <span>{{$user->meta->name}}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm d-flex">
                                    <button onclick="editData('{{url('user/'.$user->id)}}', JSON.stringify({{$user}}))"
                                            class="btn btn-warning">
                                        <span class="mdi mdi-account-edit"></span>
                                        <span>EDIT</span>
                                    </button>
                                    <button onclick="deleteData('{{url('user/'.$user->id)}}')" class="btn btn-danger">
                                        <span class="mdi mdi-account-minus"></span>
                                        <span>DELETE</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card col-12 py-3 mt-2">
                {{$users->links()}}
            </div>
        </div>
    </div>
    <form id="formDialog" class="modal fade" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title">Create New User</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name"> Name </label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name"> Email </label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name"> Mobile </label>
                        <input type="tel" name="mobile" id="mobile" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="metaName"> Meta Name </label>
                        <input type="text" name="meta[name]" id="metaName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="metaDesc"> Meta Description </label>
                        <textarea name="meta[description]" id="metaDesc" class="form-control" required rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn btn-primary">SUBMIT</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('script')
    <script>
        let isPost = true;
        let requestUrl= `{{url('user')}}`;
        const formDialog = $('#formDialog');
        formDialog.on('hidden.bs.modal', event => {
            formDialog.find('.modal-title').text('Create New User');
            requestUrl= `{{url('user')}}`;
            event.target.reset();
            isPost = true;
        });
        formDialog.on('hidden.bs.modal', event => {
            if(!isPost) event.target.reset();
        });

        function editData(link, data) {
            isPost = false;
            const object = JSON.parse(data);
            requestUrl=`{{url('user')}}/${object.id}`;
            formDialog.find("#metaName").val(object.meta.name);
            formDialog.find("input[name=name]").val(object.name);
            formDialog.find("input[name=email]").val(object.email);
            formDialog.find("input[name=mobile]").val(object.mobile);
            formDialog.find("#metaDesc").val(object.meta.description);
            formDialog.find('.modal-title').text('Update User Data');
            formDialog.modal('show');
        }

        formDialog.submit(function (e) {
            e.preventDefault();
            $.ajax(requestUrl, {
                data: $(this).serialize(),
                type: isPost ? 'POST' : 'PUT',
                success(data, textStatus, xhr) {
                    SwToast.fire({title: data, icon: 'success'}).then(() => location.reload());
                },
                error(xhr, textStatus) {
                    if(xhr.status){
                        SwToast.fire({title: xhr.responseJSON.message, icon: 'warning'});
                    }else{
                        SwToast.fire({title: xhr.responseJSON, icon: 'error'});
                    }
                }
            });

        });

        function deleteData(link) {
            SwConf.fire({text: `To confirm this User will be delete`}).then(async (result) => {
                if (result.isConfirmed) {
                    $.ajax(link, {
                        type: 'delete',
                        success(data, textStatus, xhr) {
                            SwToast.fire({title: data, icon: 'success'}).then(() => location.reload());
                        },
                        error(xhr, textStatus) {
                            SwToast.fire({title: xhr.responseJSON, icon: 'error'});
                        }
                    });
                }
            })

        }
    </script>
@endpush
