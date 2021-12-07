<x-user-layout>
    {{--------------------- 
        $slot 
    --------------------}}
    <h1>Setting Page</h1>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <input class="logout" type="submit" value="Logout">
    </form>
    {{--------------------- 
        $slot 
    --------------------}}
</x-user-layout>