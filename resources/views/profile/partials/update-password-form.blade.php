<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')

    <div>
        <label for="current_password">Current Password</label>
        <input type="password" name="current_password" class="form-control" required>
    </div>

    <div>
        <label for="password">New Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div>
        <label for="password_confirmation">Confirm New Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-warning w-100 mt-3">Update Password</button>
</form>
