@extends('layout.app')

@section('content')
<form action="{{ route('customer.auth') }}" method="post" id="custForm">
    @csrf
    <div class="mb-3">
      <label for="email" class="form-label">Email address:</label>
      <input type="email" class="form-control" name="email" id="email" autocomplete="email">
    </div>
    <div class="mb-3">
      <label for="pw" class="form-label">Password:</label>
      <input type="password" class="form-control" name="pw" id="pw" autocomplete="new-password">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Remember me</label>
    </div>
    <button type="submit" class="btn btn-primary">Log In</button>
</form>

<script>

    window.addEventListener('load', custIdx);

    function custIdx() {
        const custForm = document.getElementById('custForm');

        if (custForm) {
            custForm.addEventListener('submit', custAuth);
        }
    }

    function custAuth(e) {
        e.preventDefault();

        const custParam = new FormData();

        custParam.append('email', this.email.value);
        custParam.append('pw', this.pw.value);
        custParam.append('remember', this.remember.checked);

        axios.post(this.action, custParam)

        .then (response => {
            const custScs = response.data;
            (!response.data['ACP']) ? window.location.pathname = '/shop/dashboard' : undefined;
        })

        .catch (error => {
            console.log(error.response.data.errors);
        });
    }

</script>
@endsection
