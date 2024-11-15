@extends('layouts.master')

@section('title', 'Contact')

@section('content')
<section class="contact">


    <div class="contact-content">
        <h1>My Contact</h1>

            <div class="contact-container">
                <a href="/contact" target="_blank">
                    <img src="img/whatsapp.png" alt="">
                </a>
    
                <a href="https://www.instagram.com/wannn_il/" target="_blank">
                    <img src="img/instagram.png" alt="">
                </a>
            </div>
           

            <x-alert type="info" message="Cuma itu Sosmed yang sering gw pake..." />

        <div class="mainButton">
            <x-button route="home" text="Cukup Tau... << Return Home "/>
        </div>

        
    </div>
</section>
@endsection
