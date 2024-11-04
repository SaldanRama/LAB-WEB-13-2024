@extends('base')
@section('title', 'Tomato Hatred Club')

@section('content')
<div class="container">
    
    <div class="jumbotron text-center py-5" style="background-color: #ff4d4d; color: #fff;">
        <h1 class="display-4" style="font-weight: bold;">Welcome to the Anti-Tomato Club!</h1>
        <p class="lead" style="font-size: 1.5rem;">Join the revolution against the squishy, red menace!</p>
        <a href="{{ route('about')}}" class="btn btn-lg" style="background-color: #660000; color: white;">Learn Why We Hate 'Em</a>
    </div>

    <section id="about" class="my-5">
        <div class="row align-items-center">
            <div class="col-md-6 text-center" style="color: #ff6f61;">
                <h2>About Our Tomato Hatred</h2>
                <p>If you've ever bit into a tomato and wondered why it exists, you're not alone! We believe tomatoes are squishy, weirdly sweet, and have no place in a proper meal. Join us as we express our distaste for this overrated fruit!</p>
                <a href="{{ route('about')}}" class="btn btn-outline-secondary" style="border-color: #660000; color: #660000;">Read More</a>
            </div>
            <div class="col-md-6 text-center" style="background-color: #fbe9e7; padding: 20px;">
                <h2 style="color: #ff7043;">What We Believe</h2>
                <p>We stand for crisp veggies, delicious fruits, but no tomatoes. Ever. Innovation, creativity, and a life free from tomatoes are what we care about most.</p>
            </div>
        </div>
    </section>


</div>
@endsection
