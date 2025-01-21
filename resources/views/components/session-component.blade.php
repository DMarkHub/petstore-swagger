<div class="row">
    <div class="col">
        @if (isset($user))
            Witaj {{$user->username}} | <a href="{{route('user.logout')}}">wyloguj</a>
        @else
            Użytkownik niezalogowany | <a href="{{route('user.login')}}">zaloguj</a>
        @endif
    </div>
</div>