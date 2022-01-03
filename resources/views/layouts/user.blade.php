<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link rel="stylesheet" href="{{ asset('css/utilities.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/utilities.css') }}">
    {{ $style ?? '' }}
    
    <link rel="shortcut icon" href="{{ asset('img/b.png') }}" />
    <title>Beyond | Profile</title>

    <script src="{{ asset('js/user/utilities.js') }}" defer></script>


    <style>
        a[href = "{{ url()->current() }}"]{
            border-bottom: 3px solid var(--site_col_1);
        }
    </style>
</head>
<body class="m-0">
    @include('components.header')

    <section style="margin-top: 1.5rem;" class="_container">
        <aside>
            <div class="profile_details">
                <img class="d-b" src="{{ asset('storage/avatar/admin.jpg') }}" alt="user">
                <div class="cloak">
                    <h2 class="m-0">{{ auth()->user()->full_name }}</h2>
                    <p class="m-0">{{ auth()->user()->email }}</p>
                </div>
            </div>
            
            @if (auth()->user()->admin)
                <a style="color: blue; margin-top:1em" class="d-b" href="{{ route('admin.dashboard') }}">Dashboard</a>
            @else
                <button onclick="toggleForm()" class="cloak">Edit profile</button>
            @endif

            <!-- form -->
            <form class="cloak hide" action="{{ route('user.profile') }}" method="post">
                @csrf
                Name <br>
                <input class="input_text" type="text" name="" id=""><br>
                Intro <br>
                <textarea class="input_text"></textarea>

                <input type="submit" value="Save">
                <input onclick="toggleForm()" type="button" value="Cancel">
            </form>
            <!-- form -->
        </aside>
        <main>
            <div class="top_nav">
                <ul class="flex_align">
                    <li>
                        <a class="flex_align" href="{{ route('user.profile') }}">
                            <span class="material-icons">person</span>
                            <div>Profile</div>
                        </a>
                    </li>
                    <li>
                        <a class="flex_align" href="{{ route('user.orders.index') }}">
                            <span class="material-icons">shopping_cart</span>
                            <div>Orders</div>
                        </a>
                    </li>
                    <li>
                        <a class="flex_align" href="{{ route('user.ship_info') }}">
                            <span class="material-icons">credit_card</span>
                            <div>Address/Payments</div>
                        </a>
                    </li>
                    <li>
                        <a class="flex_align" href="{{ route('user.setting') }}">
                            <span class="material-icons">settings</span>
                            <div>Setting</div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- main content -->
            <div style="margin-bottom: 1rem">
                
                {{ $slot }}

            </div>
        </main>
    </section>
</body>
</html>
