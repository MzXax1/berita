<div data-aos="fade-left"class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">Search</div>
        <div class="card-body">
            <form action="{{route('search')}}" method="POST">
                @csrf
                <div class="input-group">
                    <input class="form-control" type="text" name="keyword" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                    <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <div class="row">
                    <ul class="list-unstyled mb-0">
                        @foreach ($categories as $item)
                         <a class="badge bg-secondary text-decoration-none link-light" href="{{url('category/'.$item->slug)}}">{{ $item->name }} {{{ $item->articles_count }}}</a>
                        @endforeach
                    </ul>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm" >
        <div class="card-header">
            Popular Post
        </div>
        <div class="card-body">
            @foreach ($popular_post->sortBy($post_order ?? 'desc') as $post)
                <div class="card mb-3">
                    <div class="row">
                        <div class="com-md-3">
                            <img src="{{asset('storage/back/'.$post->img)}}" alt="{{$post->img}}" class="img-fluid">
                        </div>

                        <div class="col-md-9">
                            <div class="card-body">
                                <p class="card-title">
                                    <a href="{{'p/'.$post->slug}}"><h5 class="card-title">{{$post->title}}</h5></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>