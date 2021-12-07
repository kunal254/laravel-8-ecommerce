<x-auth-layout>
    {{--------------------- 
        $slot 
    --------------------}}
    @if(session('status'))
    <h2 style="color:rgb(32, 221, 32)">{{session("status")}}</h2>
    @endif
     
    <p class="m-0">
        Before getting started, could you verify your email address by clicking on the link we had emailed to you? If you didn't receive the email, we will gladly send you another.
    </p>
    <p>Email is arrived between 1 to 3 minutes after the registration, Check your inbox <strong>{{ auth()->user()->email }}</strong></p>
        
    <div class="flex_align_center">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <input type="submit" value="RESEND VERIFICATION EMAIL">
        </form>
        
        <form method="POST" id="logout" action="{{ route('logout') }}">
            @csrf
            <a href="#" onclick="logout.submit()">Log Out</a>
        </form>
    </div>
    {{--------------------- 
        $slot 
    --------------------}}
</x-auth-layout>