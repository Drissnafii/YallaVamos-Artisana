@extends('layouts.admin')

@section('content')
<h1 class="mb-4">Add New User</h1>
<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
    </div>
    <div class="form-group mb-3">
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
    </div>
    <div class="form-group mb-3">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="form-group mb-3">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <div class="form-group mb-3">
        <label for="role">Role</label>
        <select name="role" class="form-control" required>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Create User</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
