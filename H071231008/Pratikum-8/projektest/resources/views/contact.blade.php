@extends('base')
@section('title', 'Tomato Hatred Club contact')

@section('content')
<section id="contact" class="my-5" style="background-color: #ffe0e0; padding: 40px;">
    <h2 class="text-center" style="color: #ff4d4d;">Contact Us</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" rows="4" placeholder="Your message here..."></textarea>
                </div>
                <button type="submit" class="btn btn-danger" style="background-color: #ff4d4d;">Send Message</button>
            </form>
        </div>
    </div>
    <div class="text-center mt-5">
        <h4>Reach us at:</h4>
        <p><i class="fas fa-envelope"></i> email@antitomatoclub.com</p>
        <p><i class="fas fa-phone"></i> +123-456-7890</p>
        <p><i class="fas fa-map-marker-alt"></i> 123 Tomato-Free Avenue, Veggie City, VG 45678</p>
    </div>

    <section id="services" class="my-5 text-center" style="background-color: #ffe0b2; padding: 40px;">
    <h2 style="color: #ff4d4d;">Our Anti-Tomato Services</h2>
    <div class="row">
        <div class="col-md-4">
            <i class="fas fa-ban fa-3x mb-3" style="color: #ff7043;"></i>
            <h4 style="color: #ff7043;">Tomato-Free Recipes</h4>
            <p>Discover recipes that are completely free of the dreaded tomato.</p>
        </div>
        <div class="col-md-4">
            <i class="fas fa-eye-slash fa-3x mb-3" style="color: #ff8a65;"></i>
            <h4 style="color: #ff8a65;">Tomato Spotting Service</h4>
            <p>We help you avoid tomato-based dishes at restaurants. No more surprises!</p>
        </div>
        <div class="col-md-4">
            <i class="fas fa-fist-raised fa-3x mb-3" style="color: #ffab91;"></i>
            <h4 style="color: #ffab91;">Tomato Protest Rallies</h4>
            <p>Join our rallies and raise awareness of the tomato problem. It's time to make a stand!</p>
        </div>
    </div>
</section>

</section>
@endsection
