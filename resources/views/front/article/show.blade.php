@extends('front.layout.template')
@section('title', $article->title ,'Laravel berita') 
@push('css')    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .replies {
    margin-left: 20px; /* Adjust the value to increase or decrease the indentation */
    padding-left: 10px;
    border-left: 2px solid #ccc; /* Optional: add a border to visually separate replies */
        }

        .reply {
            margin-top: 10px; /* Optional: add some space between replies */
        }

    </style>
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
                    <h1 class="fw-bolder mb-1">{{ $article->title }}</h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Di upload pada {{ $formattedDate  }}</div>
                    <div class="text-muted mb-2">
                        <i class="fas fa-eye"></i> {{ $article->views }}
                    </div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="{{url('category/'.$article->Category->slug)}}">{{ $article->Category->name }}</a>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="{{ asset('storage/back/'. $article->img) }}" alt="..." /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    <p class="fs-5 mb-4">{!! $article->desc !!}</p>
                </section>
                <div class="text-muted fst-italic mb-2">Di di tulis oleh <b>{{ $article->User->name }}</b></div>
                    {{-- Comment system --}}
                    @if (auth()->check())
                    <div>
                        <h1>Comment</h1>
                        <form action="{{ url('/p/' . $article->slug . '/comment') }}" method="POST">
                            @csrf
                            <textarea name="comment" cols="100" rows="5" placeholder="Write Something"></textarea>
                            <br>
                            <input type="submit" class="btn btn-primary" value="Comment">
                        </form>
                    </div>
                    @endif
                    <div>
                        <h3>All Comment</h3>
                        @foreach ($comments as $comment)
                            <div>
                                <b>{{ $comment->user->name }}</b> <!-- Access the user's name -->
                                <p>{{ $comment->comment }}</p> <!-- Assuming the comment content is stored in a 'comment' field -->
                                @if (Auth::check() && Auth::id() == $comment->user_id)
                                <button type="button" class="btn btn-danger btn-sm delete-comment-btn" data-comment-id="{{ $comment->id }}">
                                    Delete
                                </button>
                                    <a href="" class="btn btn-primary btn-sm me-2">Edit</a>
                                @endif
                                <a href="javascript:void(0);" onclick="replay(this)" data-Commentid="{{$comment->id}}">Reply</a>
                            
                                @if($comment->replies->isNotEmpty())
                                    <div class="replies">
                                        @foreach($comment->replies as $reply)
                                            <div class="reply">
                                                <b>{{ $reply->user->name }}</b> replied to <b>{{ $comment->user->name }}</b>
                                                <p>{{ $reply->comment }}</p>
                                                @if (Auth::check() && Auth::id() == $reply->user_id)
                                                <button type="button" class="btn btn-danger btn-sm delete-comment-btn" data-comment-id="{{ $reply->id }}">
                                                    Delete
                                                </button>
                                                <button type="button" value="{{$reply->id}}" class="editComment btn btn-primary btn-sm me-2">Edit</button>
                                                
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                </div>
                             @endforeach
                        <div style="display: none;" class="riplayDiv">
                            <form action="{{route('add_reply', ['slug' => $article->slug])}}" method="POST">
                                @csrf
                            <input type="hidden" id="commentId" name="commentId">
                            <textarea name="reply" id="" cols="100" rows="5"></textarea>
                            <button type="submit" class="btn btn-primary" >Replay</button>
                            <a href="javascript:void(0);" class="btn" onclick="replay_close(this)">Close</a>
                        </form>
                        </div>                   
                    </div>
            </article>
        </div>
    </div>
</div>
<div class="mb-3"></div>

<script type="text/javascript">
    function replay(caller) {
        document.getElementById('commentId').value=$(caller).attr('data-Commentid');
        $('.riplayDiv').insertAfter($(caller));
        $('.riplayDiv').show();
        
    }

    function replay_close(caller) {
            $('.riplayDiv').hide();
        }
</script>

<script>
    // Ambil semua tombol hapus komentar
    const deleteButtons = document.querySelectorAll('.delete-comment-btn');

    // Loop melalui setiap tombol dan tambahkan event listener
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Konfirmasi pengguna
            if (confirm('Are you sure you want to delete this comment?')) {
                // Ambil ID komentar dari atribut data
                const commentId = this.getAttribute('data-comment-id');
                
                // Kirim permintaan POST ke URL deleteComment
                fetch('/p/{{ $article->slug }}/delete_comment/' + commentId, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        comment_id: commentId
                    })
                })
                .then(response => {
                    if (response.ok) {
                        // Hapus komentar dari UI
                        this.parentNode.parentNode.remove();
                        alert('Comment deleted successfully');
                    } else {
                        alert('Failed to delete comment');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to delete comment');
                });
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Sisipkan event listener untuk setiap tombol edit komentar
    const editButtons = document.querySelectorAll('.editComment');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Ambil ID komentar dari atribut value tombol
            const commentId = this.value;

            // Temukan elemen komentar yang akan diubah
            const commentElement = document.querySelector(`#comment-${commentId}`);

            // Ambil teks komentar saat ini
            const currentCommentText = commentElement.querySelector('.comment-text').innerText;

            // Buat elemen textarea untuk pengeditan
            const textarea = document.createElement('textarea');
            textarea.className = 'edit-comment-textarea form-control mb-2';
            textarea.value = currentCommentText;

            // Sisipkan textarea ke dalam elemen komentar
            commentElement.querySelector('.edit-comment-container').appendChild(textarea);

            // Sembunyikan tombol edit
            this.style.display = 'none';

            // Tambahkan tombol simpan edit
            const saveEditBtn = document.createElement('button');
            saveEditBtn.className = 'save-edit-btn btn btn-success btn-sm me-2';
            saveEditBtn.innerText = 'Save';
            commentElement.querySelector('.edit-comment-container').appendChild(saveEditBtn);

            // Tambahkan event listener untuk tombol simpan edit
            saveEditBtn.addEventListener('click', function () {
                // Ambil teks yang diedit dari textarea
                const editedCommentText = textarea.value;

                // Kirim permintaan POST ke URL editComment
                fetch(`/p/{{$article->slug}}/edit_comment/${commentId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        comment_id: commentId,
                        edited_text: editedCommentText
                    })
                })
                .then(response => {
                    if (response.ok) {
                        // Perbarui teks komentar di UI
                        commentElement.querySelector('.comment-text').innerText = editedCommentText;
                        // Hapus textarea dan tombol simpan
                        textarea.remove();
                        saveEditBtn.remove();
                        // Tampilkan kembali tombol edit
                        button.style.display = 'inline-block';
                        alert('Comment edited successfully');
                    } else {
                        alert('Failed to edit comment');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to edit comment');
                });
            });

            // Sisipkan tombol batalkan edit
            const cancelEditBtn = document.createElement('button');
            cancelEditBtn.className = 'cancel-edit-btn btn btn-secondary btn-sm';
            cancelEditBtn.innerText = 'Cancel';
            commentElement.querySelector('.edit-comment-container').appendChild(cancelEditBtn);

            // Tambahkan event listener untuk tombol batalkan edit
            cancelEditBtn.addEventListener('click', function () {
                // Hapus textarea dan tombol simpan
                textarea.remove();
                saveEditBtn.remove();
                cancelEditBtn.remove();
                // Tampilkan kembali tombol edit
                button.style.display = 'inline-block';
            });
        });
    });
});

</script>


@stack('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script></script>
@endsection
