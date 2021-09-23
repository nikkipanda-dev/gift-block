@extends('layout.app')

@section('content')
<form action="{{ route('admin.auth') }}" method="post" id="admForm">
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

    window.addEventListener('load', admIdx);

    function admIdx() {
        const admForm = document.getElementById('admForm');

        if (admForm) {
            admForm.addEventListener('submit', admAuth);
        }
    }

    function admAuth(e) {
        e.preventDefault();

        const admParam = new FormData();

        admParam.append('email', this.email.value);
        admParam.append('pw', this.pw.value);
        admParam.append('remember', this.remember.checked);

        axios.post(this.action, admParam)

        .then (success => {
            console.log(success);
            window.location.pathname = '/admin/dashboard';
        })

        .catch (error => {
            console.log(error.response.data.errors);
        });
    }

</script>
@endsection
