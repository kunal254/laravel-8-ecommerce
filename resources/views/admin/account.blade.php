<x-admin-layout>
    <x-slot name="style">
        <link rel="stylesheet" href="{{ asset('css/admin/account.css') }}">
    </x-slot>
    <x-slot name="js">
        {{-- <script src="{{ asset('js/admin/category.js') }}" defer></script> --}}
    </x-slot>

    {{-- ------------------- 
            $slot 
        ------------------ --}}
    <div class="_container">
        <h1>Account</h1><br>
        <p>GENERAL</p>
        <hr>
        <div class="general">
            <div class="profile card">
                <div>
                    <img class="d-b" src="{{ asset('storage/avatar/admin.jpg') }}" alt="admin">
                    <p>{{ $user->full_name }}</p>
                </div>
            </div>
            <form class="details card" action="{{ route('admin.account.update') }}" method="POST">
                    @if (session('status'))
                        <p style="grid-column: span 2; color: rgb(20, 236, 20)">{{ session('status') }}</p>
                    @endif

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p style="grid-column: span 2; color: red">{{ $error }}</p>
                        @endforeach
                    @endif

                    @csrf
                    <input type="text" name="first_name" placeholder="First name" value="{{ $user->first_name }}" required>
                    <input type="text" name="last_name" placeholder="Last name" value="{{ $user->last_name }}" required>
                    <input type="email" name="email" placeholder="Email" value="{{ $user->email }}" disabled>
                    <input type="number" name="mobile" value="{{ $user->mobile }}" placeholder="Phone number">
                    <textarea name="intro" cols="30" rows="10" placeholder="Describe yourself here...">{{$user->intro}}</textarea>

                    <input type="submit" value="Save changes">
            </form>
        </div>


        <p style="margin-top: 3rem">SECURITY</p>
        <hr>
        <div class="security">
            <div class="card change_pwd">
                <h3>Change password</h3>
                <form action="{{ route('admin.account.pwd') }}" method="post">
                    @if (session('pwdStatus'))
                        <p style="grid-column: span 2; color: rgb(20, 236, 20)">{{ session('pwdStatus') }}</p>
                    @endif

                    @if ($errors->pwdError->any())
                        @foreach ($errors->pwdError->all() as $error)
                        <p style="color: red">{{ $error }}</p>
                        @endforeach
                    @endif

                    @csrf
                    <input type="password" name="old" placeholder="Old password" required><br>
                    <input type="password" name="password" placeholder="New password" required><br>
                    <input type="password" name="password_confirmation" placeholder="Confirm password" required><br>
                    <input type="submit" value="Change Password">
                </form>
            </div>
        </div>

    </div>
    @if (session('pwdStatus') || $errors->pwdError->any())
        <script>
            window.scrollTo(0,3000);
        </script>
    @endif

    {{-- ------------------- 
            $slot 
        ------------------ --}}
</x-admin-layout>
