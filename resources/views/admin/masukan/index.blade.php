@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Kotak Masuk (Kritik & Saran)</h4>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Pengirim</th>
                        <th>Email</th>
                        <th>Subjek</th>
                        <th>Tanggal</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($masukan as $key => $item)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td class="fw-bold">{{ $item->nama_pengirim }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->subjek }}</td>
                        <td><small>{{ $item->tgl_kirim->format('d M Y, H:i') }}</small></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modalPesan{{ $item->id_masukan }}">
                                    <i class="fas fa-eye"></i> Lihat
                                </button>

                                <form action="{{ route('pesan.destroy', $item->id_masukan) }}" method="POST" onsubmit="return confirm('Yakin hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalPesan{{ $item->id_masukan }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title">Detail Pesan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted small">DARI:</label>
                                        <p>{{ $item->nama_pengirim }} ({{ $item->email }})</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted small">TANGGAL:</label>
                                        <p>{{ $item->tgl_kirim->format('d F Y, Pukul H:i') }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted small">SUBJEK:</label>
                                        <p class="fw-bold">{{ $item->subjek }}</p>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label class="fw-bold text-muted small">ISI PESAN:</label>
                                        <div class="p-3 bg-light rounded border">
                                            {!! nl2br(e($item->pesan)) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <a href="mailto:{{ $item->email }}" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i> Balas Email
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <p>Belum ada pesan masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection