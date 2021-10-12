@extends('layout.app')

@section('content')
    shopping cart here
<script>
    window.addEventListener('load', cartLoad);

    function cartLoad()
    {
        axios.get('/products/cart/show')

        .then(response => {
            console.log(response.data);
        })

        .catch(error => {
            console.log(error.response.data.errors);
        })
    }
</script>
@endsection
