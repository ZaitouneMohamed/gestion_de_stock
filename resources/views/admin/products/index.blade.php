@extends('layouts.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Products List</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Prodcuts</li>
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
                                Add New Product
                            </button><br>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="text-center font-weight-bold">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Stock</th>
                                            <th>description</th>
                                            <th>categorie</th>
                                            <th>uniteé</th>
                                            <th>added by</th>
                                            <th>prix</th>
                                            <th>stock mini</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $item)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->stock }}</td>
                                                <td>{{ Str::limit($item->description, 10, '...') }}</td>
                                                <td>{{ $item->categorie->name }}</td>
                                                <td>{{ $item->uniteé->name }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->prix }}</td>
                                                <td>{{ $item->stock_mini }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info dropdown-toggle "
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">Info</button>
                                                        <div class="dropdown-menu" x-placement="bottom-start"
                                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
                                                            <a class="dropdown-item" href="#">Action</a>
                                                            <form action="{{ route('products.destroy', $item->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    onclick="return confirm('Are you sure?')"
                                                                    class="dropdown-item">delete</button>
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
                                    {{ $products->links() }}
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
                        <h5 class="modal-title" id="exampleModalLabel">Create New Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('products.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">product name</label>
                                    <input type="text" class="form-control" name="name" placeholder="product name"
                                        id="">
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Stock</label>
                                    <input type="number" class="form-control" name="stock" placeholder="stock here"
                                        id="">
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Stock mini</label>
                                    <input type="number" class="form-control" name="stock_mini" placeholder="stock mini"
                                        id="">
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Prix</label>
                                    <input type="number" class="form-control" name="prix" placeholder="prix"
                                        id="">
                                </div><br>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Categorie</label>
                                        <select class="form-select" name="categorie" id="">
                                            <option selected>Shoose</option>
                                            @foreach (\App\Models\Categorie::all() as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Uniteé</label>
                                        <select class="form-select" name="unitee" id="">
                                            <option selected>Shoose</option>
                                            @foreach (\App\Models\Uniteé::all() as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>
                                <div class="col-12">
                                    <label for="exampleFormControlInput1" class="form-label">Description</label>
                                    <textarea placeholder="description" class="form-control" name="description" id="" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
