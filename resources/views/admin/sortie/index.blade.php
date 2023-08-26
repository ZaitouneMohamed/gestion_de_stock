@extends('layouts.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Sortie</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Entreé</li>
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
                                Add New Entree
                            </button><br>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="text-center font-weight-bold">
                                            <th>#</th>
                                            <th>product</th>
                                            <th>Prix d'achat</th>
                                            <th>Stock avant</th>
                                            <th>qte</th>
                                            <th>added by</th>
                                            <th>observation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($entree as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->prix_achat }}</td>
                                                <td>{{ $item->stock_avant }}</td>
                                                <td>{{ $item->qte }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ Str::limit($item->observation, 10, '...') }}</td>
                                                {{-- <td>
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
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    {{ $entree->links() }}
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
                        <h5 class="modal-title" id="exampleModalLabel">Create New Entree</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('AddSortie') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Categorie</label>
                                        <select class="form-select" id="categorie">
                                            <option selected>Shoose</option>
                                            @foreach (\App\Models\Categorie::all() as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Products</label>
                                        <select class="form-select" name="product_id" id="products">
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">prix d'achat</label>
                                    <input type="text" class="form-control" name="prix_achat" placeholder="prix"
                                        id="">
                                </div>
                                <div class="col-6">
                                    <label for="exampleFormControlInput1" class="form-label">Qte</label>
                                    <input type="number" class="form-control" name="qte" placeholder="qte here"
                                        id="">
                                </div>
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

@section('scripts')
    <script>
        document.getElementById('categorie').addEventListener('change', function() {
            var selectedCategorie = this.value;
            products = "";
            $.ajax({
                url: '{{ route('productsOfCategorie') }}',
                type: 'GET',
                data: {
                    categorie_id: selectedCategorie
                },
                dataType: 'json',
                success: function(response) {
                    var subCategoriesHtml = '';
                    response.forEach(function(categorie) {
                        products += '<option value="' + categorie.id + '">' + categorie.name +
                            '</option>';
                    });
                    document.getElementById('products').innerHTML = products;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>
@endsection
