@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($posts as $post)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card coffee-card border-0 shadow-sm">
                <img src="{{ asset('img/' . $post['Gambar']) }}"
                     class="card-img-top img-fluid"
                     alt="{{ $post['Jenis Kopi'] }}"
                     style="height: 200px; object-fit: cover;">

                <div class="card-body">
                    <h5 class="card-title">{{ $post['Jenis Kopi'] }}</h5>
                    <p class="card-text text-muted">{{ $post['kualitas'] }}</p>

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-{{ $post['Stok'] > 5 ? 'success' : 'warning' }}">
                            Stok: {{ $post['Stok'] }}
                        </span>
                        <span class="fw-bold text-coffee">{{ $post['Harga'] }}</span>
                    </div>
                </div>

                <div class="card-footer bg-white">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-outline-danger float-end">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
