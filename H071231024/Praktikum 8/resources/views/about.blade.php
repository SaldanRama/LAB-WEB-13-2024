@extends('layouts.master')

@section('title', 'About')

@section('content')

    <section class="about">

        <div class="about-content">
            <h1>A story about me</h1>
            <p>
                Yoo Bruh, gw Ilham a.k.a Wawan! Mahasiswa Sistem Informasi Universitas Hasanuddin. Website ini dibuat menggunakan laravel untuk memenuhi Tugas Praktikum Pemrograman Web.
                
                Ok. Hobby gw main game, nonton, main bola, dan ngoding tentunya. Dah itu aja, btw laravel bikin pusing bjeerrrrrr!!!!!!!!
                
                <br><br>
                Nggak lupa, ada beberapa lagu favorit gw.
                Beberapa musik favorit gw yaitu:     
                <div>
                    <ol>
                        <li>2Pac, Outlawz - Hit 'Em Up
                            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/0Z2J91b2iTGLVTZC4fKgxf?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                        </li>
                        <li>
                            2Pac, Big Syke - All Eyez On Me
                            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/4VQNCzfZ3MdHEwwErNXpBo?utm_source=generator" width="100%" height="152" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
                        </li>
                    </ol>
                </div>
            </p>

            <div class="mainButton">
                <x-button route="contact" text="Ni Contact Gw >>" />
            </div> 
        </div>

        <div class="game-content">
            <h1>My Favorite Game</h1>

            <div class="picture">
                <img src="img/RDR2PIC.jpg" alt="Foto Profil">
            </div>

            <p>
                Salah satu Game Favorit gw ni boss selain GTA 5. Realistis, grafiknya mantap, storynya keren, dan gameplaynya juga seru. Sebenarnya ni game udah lama rilis, tapi gw baru main sekarang. Kalo lo suka game open-world, gw saranin buat mainin ni game. Apalagi kalo lo suka game western.

                <br><br>

                Sebenarnya gw juga suka game MOBA, tapi gw lebih sering main Mobile Legends. Siapa tau lo main yekan, bolehlah mabar. Contact aja!
            </p>
        </div>
    </section>

@endsection
