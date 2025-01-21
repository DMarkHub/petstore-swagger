<html>

<head>
    <title>Petstore Swagger</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <x-session-component></x-session-component>
        <div class="row">
            <div class="col">
                Store:
                <a href="{{route('store.show.inventory')}}">Inventory</a> |
                <a href="{{route('store.show.order')}}">Find order</a> |
                <a href="{{route('store.order.create')}}">Create order</a> |
                <a href="{{route('store.order.delete')}}">Delete order</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                User:
                <a href="{{route('user.create')}}">Create user</a> |
                <a href="{{route('user.show')}}">Find user</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                Pet:
                <a href="{{route('pet.show')}}">Find pet</a> |
                <a href="{{route('pet.find.by.status')}}">Find by status</a> |
                <a href="{{route('pet.create')}}">Pet create</a>
            </div>
        </div>
        @yield('content')
        @yield('form')
    </div>
    <div class="container">
        <div class="row">
            @if (isset($resultComponentData[0]) && !empty($resultComponentData[0]))
                <div class="col">
                    <x-result-component :data="$resultComponentData"
                        :actions="$resultComponentActions"></x-result-component>
                </div>
            @endif
            @if (isset($message))
                <div class="col">
                    <x-message-component :data="$message"></x-message-component>
                </div>
            @endif
        </div>
        @if ($errors->any())
            <div class="row">
                <div class="col">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>

</html>