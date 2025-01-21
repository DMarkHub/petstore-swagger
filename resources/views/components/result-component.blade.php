@foreach ($data as $item)
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">KEY</th>
                <th scope="col">VALUE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($item as $key => $value)
                <tr>
                    <td>{{$key}}</td>
                    @if (is_array($value) && isset($value['name']))
                        <td>{{$value['name']}}</td>
                    @elseif (is_array($value) && is_string($value[0]))
                        <td>{{implode(', ', $value)}}</td>
                    @elseif (is_array($value) && is_array($value[0]))
                        <td>{{implode(', ', array_map(function ($element) {
                            return $element['name'] ?? ''; }, $value))}}</td>
                    @else
                        <td>{{$value}}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    @foreach ($actions as $actionName => $action)
        <a href="{{$action}}">{{$actionName}}</a>
    @endforeach
@endforeach