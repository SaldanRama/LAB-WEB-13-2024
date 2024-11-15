@extends('layouts.master')

@section('title', 'Home')

@section('content')

    <section class="home">
        <div class="home-content">
            <h1>Hi... I'am Ilham Kurniawan</h1>
            <h3>Mahasiswa Sistem Informasi Universitas Hasanuddin</h3>
            <p>Mengamati, merenung, dan mengkode di dalam bayangan.</p>
            <div class="mainButton">
                <x-button route="about" text="See More..." />
            </div>
        </div>

        <div class="picture">
            <img src="img/profile.jpg" alt="Foto Profil" width="400">
        </div>
    </section>

@endsection
