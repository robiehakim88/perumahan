@extends('layouts.app')

@section('title', 'Selamat Datang di Dashboard Taqiya Land RT 003 RW 004')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $houseCount ?? 0 }}</h3>
                <p>Total Rumah</p>
            </div>
            <div class="icon">
                <i class="fas fa-home"></i>
            </div>
            <a href="{{ route('houses.index') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $tenantCount ?? 0 }}</h3>
                <p>Total Pengontrak</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('tenants.index') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $occupiedCount ?? 0 }}</h3>
                <p>Rumah Ditempati</p>
            </div>
            <div class="icon">
                <i class="fas fa-door-open"></i>
            </div>
            <a href="{{ route('reports.occupancy') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $vacantCount ?? 0 }}</h3>
                <p>Rumah Kosong</p>
            </div>
            <div class="icon">
                <i class="fas fa-door-closed"></i>
            </div>
            <a href="{{ route('reports.occupancy') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
    
    
    
</div>
@endsection