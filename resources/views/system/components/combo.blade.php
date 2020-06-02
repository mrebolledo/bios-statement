<x-combo
    :label="$label"
    :name="$name"
    :display="$display"
    :entity="$entity"
    :filter="$filter"
    :filterField="$filterField"
></x-combo>

@if($functionNext)
    <script>
        {!! $functionNext !!}
    </script>
@endif
