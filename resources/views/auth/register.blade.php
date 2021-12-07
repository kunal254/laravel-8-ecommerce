<x-auth-layout>
    {{--------------------- 
        $slot 
    --------------------}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color:red">{{ $error }}</p>
        @endforeach
    @endif
        <form action="{{ route('register') }}" method="POST" autocomplete="off">
            @csrf
            <label for="first_name">First Name</label><br>
            <input class="fill_data" type="text" name="first_name" id="first_name" required><br><br>

            <label for="last_name">Last Name</label><br>
            <input class="fill_data" type="text" name="last_name" id="last_name" required><br><br>

            <label for="email">Email</label><br>
            <input class="fill_data" type="email" name="email" id="email" required><br><br>

            <label for="password">Password</label><br>
            <input class="fill_data" type="password" name="password" id="password" required><br><br>

            <label for="password_confirmation">Confirm Password</label><br>
            <input class="fill_data" type="password" name="password_confirmation" id="password_confirmation" required><br><br>
            
            <div>
                <div class="submit">
                    <a href="{{ route('login') }}">Already registered?</a>
                    <input type="submit" value="REGISTER">
                </div>
            </div>
        </form>
    {{--------------------- 
        $slot 
    --------------------}}
</x-auth-layout>