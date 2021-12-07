<x-auth-layout>
    {{--------------------- 
        $slot 
    --------------------}}
    @if(session('status'))
        <p style="color:red">{{session("status")}}</p>
    @endif
        <form action="{{ route('login') }}" method="post" autocomplete="off">
            @csrf
            <label for="email">Email</label><br>
            <input class="fill_data" type="email" name="email" id="email" required><br><br>

            <label for="password">Password</label><br>
            <input class="fill_data" type="password" name="password" id="password" required><br><br>

            <input type="checkbox" id="rem" name="remember">
            <label for="rem">Remember me</label><br><br>

            <div>
                <div class="submit">
                    <a href="{{ route('register') }}">Create an account</a>
                    <input type="submit" value="LOG IN">
                </div>
            </div>
        </form>
    {{--------------------- 
        $slot 
    --------------------}}
</x-auth-layout>