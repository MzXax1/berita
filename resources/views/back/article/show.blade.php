@extends('back.layout.template')


@section('title', 'Detail Articles -Admin')
    

@section('content')
    
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Articles</h1>
      </div>

      <div class="mt-3">
        <table class="table table-striped tabel-bordered">
           <tr>
            <th width="250px">Title</th>
            <td>: {{ $articles->title }}</td>
           </tr>
           <tr>
            <th>Category</th>
            <td>: {{ $articles->Category->name }}</td>
           </tr>
           <tr>
            <th>Description</th>
            <td>: {!! $articles->desc !!}</td>
           </tr>
           <tr>
            <th>Images</th>
            <td>:
               <a href="{{ asset('storage/back/'.$articles->img) }}" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('storage/back/'.$articles->img) }}" alt="" width="200px" ></a>
            </td>
           </tr>
           <tr>
            <th>Views</th>
            <td>: {{ $articles->views }} x</td>
           </tr>
           <tr>
            <th>Status</th>
            @if ($articles->status == 1)
                <td><span class="bedge bg-success">Published</span></td>
            @else
                <td><span class="bedge bg-danger">Private</span></td>
            @endif
           </tr>
           <tr>
            <th>Publish date</th>
            <td>: {{ $articles->publish_date }}</td>
           </tr>
           <tr>
            <th>Writer</th>
            <td>: {{ $articles->User->name }}</td>
           </tr>
        </table>
        <div class="float-end">
            <a href="{{ route('article.index') }}" class="btn btn-primary">Back</a>
        </div>
      </div>
    
    </main>
  

@endsection