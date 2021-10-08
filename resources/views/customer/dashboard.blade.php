@extends('layout.app')

@section('content')
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Account
        </button>

        <a href="{{ route('customer.products.index') }}">Browse all</a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="{{ route('customer.settings.index') }}">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Log Out</a></li>
        </ul>
    </div>

    <div id="prodList">

    </div>
<script>
    window.addEventListener('load', custDbrd);

    function custDbrd()
    {
        getProd();
    }

    function getProd()
    {
        axios.get('/shop/products/all')

        .then(response => {
            console.log('res: ', response);
        })

        .catch(error => {
            console.log('erro: ', error.response.data.errors);
        })
    }
</script>
@endsection
