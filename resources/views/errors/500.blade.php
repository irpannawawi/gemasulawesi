@extends('layouts.web')
@section('content')
    <div class="main-container container" id="main-container">
        <div class="row">
            <section>
                <div class="container">
                    <div class="text">
                        <h1>Page Not Found</h1>
                        <p>We can't seem to find the page you're looking for. Please check the URL for any typos.</p>
                        <div class="input-box">
                            <input type="text" placeholder="Search...">
                            <button><i class="fa-solid fa-search"></i></button>
                        </div>
                        <ul class="menu">
                            <li><a href="#">Go to Homepage</a></li>
                            <li><a href="#">Visit our Blog</a></li>
                            <li><a href="#">Contact support</a></li>
                        </ul>
                    </div>
                    <div><img class="image" src="errorimg.png" alt=""></div>
                </div>
        </div>
        </section>
    </div>
    </div>
@endsection
