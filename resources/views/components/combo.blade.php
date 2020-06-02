<div class="form-group">
    <label class="form-label">{{ $label }}</label>
    <select name="{{ $name }}" id="" class="form-control">
        @if(!$isEdit)
            <option value="" selected="" disabled>Seleccione...</option>
        @endif
            @foreach($list as $item)
                @if($isEdit)
                    @if($comparator == $item->{$idField})
                        <option value="{{ $item->{$idField} }}" selected>{{ $item->{$display} }}</option>
                    @else
                        <option value="{{ $item->{$idField} }}">{{ $item->{$display} }}</option>
                    @endif
                @else
                    <option value="{{ $item->{$idField} }}">{{ $item->{$display} }}</option>
                @endif
            @endforeach
    </select>
</div>
