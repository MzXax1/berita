@extends('back.layout.template')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
      /* CSS untuk membuat tabel responsif */
        @media screen and (max-width: 767px) {
          /* Atur tabel menjadi full width saat layar berukuran kecil */
          .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
          }
          /* Atur ukuran font untuk memastikan legibilitas pada layar kecil */
          .table-responsive table td,
          .table-responsive table th {
            font-size: 12px;
          }
        }
    </style>
@endpush

@section('title', 'List Articles -Admin')
    

@section('content')
    
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Articles</h1>
      </div>

      <div class="mt-3">
        <a href="{{url('article/create')}}" class="btn btn-success mb-2">Create</a>
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

          {{-- success allert --}}
          <div class="swal" data-swal="{{ session('success') }}">

          </div>
        <table class="table table-striped tabel-bordered" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Categories</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th>Publish Date</th>
                    <th>Function</th>
                </tr>
            </thead>

            <tbody>
              
            </tbody>

        </table>
      </div>
  </main>
  

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- allert success --}}
    <script>
        const swal =$('.swal').data('swal');
        if (swal) {
          Swal.fire({
            'title' : 'Success',
            'text' : swal,
            'icon' : 'success',
            'showConfirmButton' : false,
            'timer' : 2500
          })
        }

        $(document).ready(function() {
    $('#dataTable').on('click', '.delete-article-btn', function() {
        var articleId = $(this).data('id'); // Corrected here

        Swal.fire({
            title: 'Delete Article',
            text: 'Are you sure you want to delete this article?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  url: '/article/' + articleId,
                  type: 'DELETE',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response) {
                      Swal.fire('Deleted!', response.message, 'success');

                      // Remove the row from the DataTable
                      $('#dataTable').DataTable().row($('#dataTable').find('button[data-id="' + articleId + '"]').parents('tr')).remove().draw();

                      // Optionally, update any UI elements or perform other actions
                  },
                  error: function(xhr, ajaxOptions, thrownError) {
                      Swal.fire('Error!', 'An error occurred while deleting the article.', 'error');
                  }
              });
            }
        });
    });
});

    </script>
{{-- datatable --}}

<script>
 $(document).ready(function() {
  $('#dataTable').DataTable({
    processing: true,
    serverSide: true, // Corrected typo here
    ajax: '{{ url()->current() }}',
    columns: [
      {
        data: 'DT_RowIndex',
        name: 'DT_RowIndex'
      },
      {
        data: 'title',
        name: 'title'
      },
      {
        data: 'categories_id',
        name: 'categories_id'
      },
      {
        data: 'views',
        name: 'views'
      },
      {
        data: 'status',
        name: 'status'
      },
      {
        data: 'publish_date',
        name: 'publish_date'
      },
      {
        data: 'button',
        name: 'button'
      },
    ]
  });
});

</script>
@endpush