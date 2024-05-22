@extends('front.layout.template')
@section('title', $articles->title ,'Laravel berita') 
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endpush
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center"> <!-- Menggunakan justify-content-center untuk mengatur konten menjadi di tengah -->
        <div class="col-lg-8 p-0"> <!-- Menambahkan p-0 untuk menghapus margin dan padding default -->
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">{{ $articles->title }}</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Di upload pada {{ $formattedDate  }}</div>
                    <div class="text-muted mb-2">
                        <i class="fas fa-eye"></i> {{ $articles->views }}
                    </div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="{{url('category/'.$articles->Category->slug)}}">{{ $articles->Category->name }}</a>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="{{ asset('storage/back/'. $articles->img) }}" alt="..." /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    <p class="fs-5 mb-4">{!! $articles->desc !!}</p>
                </section>
                <div class="text-muted fst-italic mb-2">Di di tulis oleh <b>{{ $articles->User->name }}</b></div>
            </article>
        </div>
    </div>
</div>
@endsection
