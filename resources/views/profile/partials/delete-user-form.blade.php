<form method="POST" action="{{ route('profile.destroy') }}">
    @csrf
    @method('DELETE')

    <p class="text-danger">This action is irreversible. Proceed only if you're sure.</p>

    <div>
        <label for="password">Confirm Your Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-danger w-100 mt-3">Delete Account</button>
</form>
