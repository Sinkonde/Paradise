<div class="{{$classes}} flex flex-col">
    <label for="{{$name}}" class="font-thin text-{{$color}}-500 text-xs">{{$label}}</label>

    @if ($select == 'true')
        <select name="{{$name}}" class="mt-2 text-{{$color}}-400 focus:text-{{$color}}-800 p-1 border focus:border-{{$color}}-200 rounded focus:bg-white bg-{{$color}}-100 rounded text-xs">
            {{$slot}}
        </select>
    @else
        <input id="{{$name}}" {{$readonly}} name="{{$name}}" value="{{$value}}" type="{{$type}}" class="mt-2 text-{{$color}}-400 focus:text-{{$color}}-800 p-1 focus:border-{{$color}}-200 border rounded focus:bg-white bg-{{$color}}-100 rounded text-xs" />
    @endif
</div>
@if ($type == 'date')
<script>
    flatpickr("#{{$name}}", {});
</script>
@endif
