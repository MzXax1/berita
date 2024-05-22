@extends('front.layout.template')
@section('title', 'Category '. $category .' - Laravel berita') 
    @section('content')
                <!-- Page content-->
                <div class="container">
                    <div class="mb-3" data-aos="fade-down" data-aos-duration="2500">
                        <form action="{{route('search')}}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input class="form-control" type="text" name="keyword" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                            </div>
                        </form>
                    </div>
                 <p>Showing articles with category <b>{{$category}}</b></p>
                    <div class="row" data-aos="fade-up" data-aos-duration="2000" >
                        <!-- Blog entries-->                       
                            <!-- Featured blog post-->
                            @forelse ($articles as $item)
                                <div class="col-4">
                                    <div class="card mb-4 shadow"> 
                                        <a href="{{ url('p/'.$item->slug)}}">
                                            <img class="card-img-top post-img" src="{{ asset('storage/back/'. $item->img) }}" alt="..." /></a>  
                                        <div class="card-body card-height"> 
                                            <div class="small text-muted">
                                                {{ $item->created_at->format('d-m-Y') }}

                                                <a href="{{url('categories')}}">{{ $item->Category->name }}</a>
                                            </div> 
                                            <h2 class="card-title h4">{{ $item->title }}</h2>   
                                            <p class="card-text">{{ Str::limit(strip_tags($item->desc), 95, '...') }}</p> 
                                            <a class="btn btn-primary" href="{{ url('p/'.$item->slug)}}">Read more →</a>    
                                         </div>  
                                    </div>  
                              </div>
                              @empty
                              <h3>Not found</h3>
                        @endforelse 
                     </div>     
                 {{ $articles->links()}}  
            </div>
    @endsection
  