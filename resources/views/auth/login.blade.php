@extends("base")
@section("content")

<h1>Se connecter</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('auth.login') }}" method="post" class="vstack gap-3">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value={{ old('email') }}>
                @error("email")
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
            @error("email")
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success mt-3">Se connecter</button>
            </div>
             
        </form>
    </div>
</div>

@endsection 