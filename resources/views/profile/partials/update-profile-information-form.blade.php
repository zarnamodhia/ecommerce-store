<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
    </div>

    <button type="submit" class="btn btn-primary w-100 mt-3">Save Changes</button>
</form>
