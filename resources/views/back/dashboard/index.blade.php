@extends('back.layout.template')  
  
@section('title', 'Dashboard')


  
@section('content') 
      
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">  
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> 
        <h1 class="h2">Dashboard</h1> 
          
      </div>  
      
      <div class="row"> 
        <div class="col-6"> 
          <div class="card text-white bg-primary mb-3" style="max-width: 100%"> 
            <div class="card-header">Total Articles</div> 
            <div class="card-body"> 
              <h5 class="card-title">{{ $total_articles }} Articles</h5>  
              <a href="{{url('article')}}" class="text-white">View</a>  
            </div>  
          </div>  
            
        </div>  
        <div class="col-6"> 
          <div class="card text-white bg-secondary mb-3" style="max-width: 100%"> 
            <div class="card-header">Total Categories</div> 
            <div class="card-body"> 
              <h5 class="card-title">{{ $total_categories }} Categories</h5>  
              <a href="{{url('category')}}" class="text-white">View</a> 
            </div>  
        </div>  
      </div>  
      
      <div class="row"> 
        <div class="col-6"> 
          <h4>latest Articles</h4>  
          <table class="table table-bordered tabel-striped">  
            <thead> 
              <tr>  
                <th>No</th> 
                <th>Title</th>  
                <th>Category</th> 
                <th>Create</th> 
                <th>Action</th> 
              </tr> 
            </thead>  
            <tbody> 
              @foreach ($latest_articles as $item)  
                <tr>  
                  <td>{{ $loop->iteration }}</td> 
                  <td>{{ $item->title }}</td> 
                  <td>{{ $item->Category->name }}</td>                  
                  <td>{{ $item->created_at }}</td>    
                  <td>  
                    <a href="{{url('article/'. $item->id)}}" class="btn btn-secondary">Detail</a>   
                  </td>                 
                </tr> 
              @endforeach 
            </tbody>  
          </table>  
        </div>  
        <div class="col-6"> 
          <h4>Popular Articles</h4> 
          <table class="table table-bordered tabel-striped">  
            <thead> 
              <tr>  
                <th>No</th> 
                <th>Title</th>  
                <th>Category</th> 
                <th>View</th>
                <th>Action</th> 
              </tr> 
            </thead>  
            <tbody> 
              @foreach ($popular_articles as $item) 
                <tr>  
                  <td>{{ $loop->iteration }}</td> 
                  <td>{{ $item->title }}</td> 
                  <td>{{ $item->Category->name }}</td>  
                  <td>{{ $item->views }}</td>  
                  <td>  
                    <a href="{{url('article/'. $item->id)}}" class="btn btn-secondary">Detail</a>   
                  </td>   
                                  
                </tr> 
              @endforeach 
            </tbody>  
          </table>  
        </div>  
      </div>  
      
    </main> 
    
    
    
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>  
    
    
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"> 
      </script><script src="{{asset('back/js/dashboard.js')}}"></script>  
  </body> 
</html> 
  
@endsection 