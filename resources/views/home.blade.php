@extends('layouts.app')

@section('content')
<section class="hero" id="hero">
    <div class="hero-text">
        <p>Earn money, get results.</p>
    </div>
</section>

<!-- Feature Section -->
<section class="feature">
    <div class="feature-wrap">
        <div class="feature-container">
            <div class="feature-title">
                <h1>Features</h1>
            </div>

            <div class="content-card">
                <a class="card" href="{{route('register')}}">
                    <div class="front" style="background-image: url(/images/Survey-creator.png);">
                        <p>Create</p>
                    </div>
                    <div class="back">
                        <div>
                            <p>Easily create surveys with the intuitive survey creator.</p>
                            <button class="button">Sign Up</button>
                        </div>
                    </div>
                </a>
                <a class="card" href="{{route('register')}}">
                    <div class="front" style="background-image: url(/images/market.png);">
                        <p>Shop</p>
                    </div>
                    <div class="back">
                        <div>
                            <p>Spend your earnt tokens in the market.</p>
                            <button class="button">Sign Up</button>
                        </div>
                    </div>
                </a>
                <a class="card" href="{{route('register')}}">
                    <div class="front" style="background-image: url(/images/data.png);">
                        <p>Analyse</p>
                    </div>
                    <div class="back">
                        <div>
                            <p>Analyse your data with precomputed graphs.</p>
                            <button class="button">Sign Up</button>
                        </div>
                    </div>
                </a>

            </div>
        </div>
</section>
<!-- Copyrights Section -->
<div class="copyright">&copy;2019- <strong>surve.ac</strong></div>
</div>
@stop
