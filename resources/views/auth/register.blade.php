@extends('layout.app')

@section('content')
<form>
    @csrf
    <div class="mb-3">
      <label for="email" class="form-label">Email address:</label>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" autocomplete="email">
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
@endsection
