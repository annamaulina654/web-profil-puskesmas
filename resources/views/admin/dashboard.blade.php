@extends('layouts.admin')

@section('title', 'Dashboard - Admin Puskesmas')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Dashboard</h2>
            <p class="text-muted">Ringkasan data aplikasi profil Puskesmas.</p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Layanan</h5>
                    <p class="card-text fs-2">5</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Berita</h5>
                    <p class="card-text fs-2">12</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pesan Masuk</h5>
                    <p class="card-text fs-2">3</p>
                </div>
            </div>
        </div>
    </div>
@endsection