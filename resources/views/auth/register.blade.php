@extends('layout.app')

@section('content')
<form action="{{ route('register.store') }}" method="post" id="regForm">
    @csrf
    <div class="mb-3">
        <label for="fname" class="form-label">First name:</label>
        <input type="text" class="form-control" name="fname" id="fname" autocomplete="given-name">
      </div>
      <div class="mb-3">
        <label for="lname" class="form-label">Last name:</label>
        <input type="text" class="form-control" name="lname" id="lname" autocomplete="family-name">
      </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email address:</label>
      <input type="email" class="form-control" name="email" id="email" autocomplete="email">
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password:</label>
      <input type="password" class="form-control" name="password" id="password" autocomplete="new-password">
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Repeat password:</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" autocomplete="new-password">
      </div>
    <button type="submit" class="btn btn-primary">Register</button>
  </form>

<script>
    window.addEventListener('load', regLoad);

    function regLoad() {
        const regForm = document.getElementById('regForm');

        if (regForm) {
            regForm.addEventListener('submit', testfn)
        }
    }

    function testfn(e) {
        e.preventDefault();
        console.log(this.fname.value);

        const regParam = new FormData()

        regParam.append('first_name', this.fname.value);
        regParam.append('last_name', this.lname.value);
        regParam.append('email', this.email.value);
        regParam.append('password', this.password.value);
        regParam.append('password_confirmation', this.password_confirmation.value);

        axios.post(this.action, regParam)

        .then (success => {
            console.log(success)
        })

        .catch (error => {
            console.log(error.response.data.errors)
        });
    }

</script>
@endsection
