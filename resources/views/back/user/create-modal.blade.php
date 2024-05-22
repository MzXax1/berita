<div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Create User</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ url('users')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="name" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old ('name')}}">

                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old ('email')}}">

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-3">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" value="{{ old ('email')}}">

              @error('password')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror

          </div>
            <div class="mb-3">
              <label for="confirmasi_password">Confirm Password</label>
              <input type="password" name="confirmasi_password" id="confirmasi_password" class="form-control @error('confirmasi_password') is-invalid @enderror" value="{{ old ('email')}}">

              @error('confirmasi_password')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror

          </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
          </form>
        </div>
        
      </div>
    </div>
  </div>