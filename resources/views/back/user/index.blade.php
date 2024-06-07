@extends('back.layout.template')

@section('title', 'List Users -Admin')

@section('content')
    
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
      </div>

      <div class="mt-3">
         @if ($errors->any())
          <div class="my-3">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          </div>
          @endif

          @if (session('success'))
            <div class="my-3">
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            </div>
          @endif

        <table class="table table-striped tabel-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created at</th>
                    <th>Function</th>
                </tr>
            </thead>

            <tbody>
              @foreach ($users as $item)
                  <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $item->$name}}</td>
                    <td>{{ $item->$email}}</td>
                    <td>{{ $item->$created_at}}</td>
                    <td>
                     <div class="text-center">
                      <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalUpdate{{$item->id}}">Edit</button>
                      @if (auth()->user()->role == 1)
                        @if ($item->id != auth()->user()->id)
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$item->id}}">Delete</button>
                        @endif
                      @endif
                     </div>
                    </td>
                  </tr>
              @endforeach
            </tbody>

        </table>
      </div>
      @include('back.user.create-modal')
      <!-- Modal update -->
      @include('back.user.update-modal')
      <!-- Modal delete -->
      @include('back.user.delete-modal')
    </main>
  

@endsection