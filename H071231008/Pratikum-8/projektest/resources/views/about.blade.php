@extends('base')
@section('title', 'Tomato Hatred Club About')

@section('content')
<div class="container">
    <section id="about" class="my-5">
        <div class="row align-items-center">
            <div class="col-md-6 text-center" style="color: #ff6f61;">
                <h2>Why We Can't Stand Tomatoes</h2>
                <p>Let's face it, tomatoes are weird. They're neither fully fruit nor vegetable, just floating awkwardly in between. You bite into one and suddenly you're dealing with seeds and juice everywhere—disgusting, right?</p>
                <p>They're squishy, sometimes sour, and let's not even talk about how they ruin burgers, salads, and just about any dish they touch. The texture? Ugh, slimy. The taste? Confusing and not worth the effort.</p>
                <p>That's why we're here. To stand against the tyranny of tomatoes, one squishy red ball at a time.</p>
                <a href="{{ route('contact')}}" class="btn btn-outline-secondary" style="border-color: #660000; color: #660000;">Join the Fight</a>
            </div>

            <div class="col-md-6 text-center" style="background-color: #fbe9e7; padding: 20px;">
                <img src="https://ih1.redbubble.net/image.4503271572.6422/bg,f8f8f8-flat,750x,075,f-pad,750x1000,f8f8f8.jpg" alt="https://ih1.redbubble.net/image.4503271572.6422/bg,f8f8f8-flat,750x,075,f-pad,750x1000,f8f8f8.jpg" class="img-fluid" style="max-width: 100%; height: auto;">
            </div>
        </div>
    </section>

   
</div>
@endsection
