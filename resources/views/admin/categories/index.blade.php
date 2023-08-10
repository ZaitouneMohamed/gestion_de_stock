@extends('layouts.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">categorie List</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Categories</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary margin-5 text-white" data-toggle="modal"
                                data-target="#Modal2">
                                Add New categorie
                            </button>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="text-center font-weight-bold">
                                            <th>Name</th>
                                            <th>added by</th>
                                            <th>product count</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $item)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->Products->count() }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info dropdown-toggle"
                                                            style="border-radius: 15px" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">action</button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <form action="{{route('categories.destroy',$item->id)}}" method="post">
                                                                @csrf
                                                                @method("delete")
                                                                <button type="submit" class="dropdown-item">delete</button>
                                                            </form>
                                                            <a class="dropdown-item" href="#">Something else here</a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#">Separated link</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create New Categorie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('categories.store') }}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group row">
                                <label for="lname" class="col-sm-3 text-right control-label col-form-label">name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="lname"
                                        placeholder="Categorie name">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
