@extends('app.components.modals.modal')
@section('modal-title', 'Serializar: '.$title)
@section('modal-icon','list-ol')
@section('modal-content')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/nestable/nestable.css') }}">
    <script src="{{ mix('/vendor/libs/nestable/nestable.js') }}"></script>
    <script src="{{mix('/vendor/libs/jstree/jstree.js')}}" ></script>
    <div class="row">
        <div class="col-md-12">
            <div class="dd" id="nestable">
                <ol class="dd-list">
                    @foreach($records as $record)
                        <li class="dd-item" data-id="{{ $record['id'] }}">
                            <div class="dd-handle">
                                {{ $record['name'] }}
                            </div>
                            @if($depth > 1 && isset($record['children']) && count($record['children']) > 0)
                                <ol class="dd-list">
                                    @foreach($record['children'] as $child)
                                        <li class="dd-item" data-id="{{ $child['id'] }}">
                                            <div class="dd-handle">
                                                &nbsp;{{ $child['name'] }}
                                            </div>
                                            @if($depth > 2 && isset($record['children']) &&  count($child['children']) > 0)
                                                <ol class="dd-list">
                                                    @foreach($child['children'] as $c)
                                                        <li class="dd-item" data-id="{{ $c['id'] }}">
                                                            <div class="dd-handle">
                                                                {{ $c['name'] }}
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ol>
                                            @endif
                                        </li>
                                    @endforeach
                                </ol>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

    <form class="my-5" role="form"  id="serialization-form">
        @csrf
        <div class="form-group">
            <label class="form-label">Resut</label>
            <textarea id="nestable-output" name="fields" class="form-control input-sm"></textarea>
        </div>

    </form>

    <script>
        // Nestable
        $(function() {
            function updateOutput(e) {
                var list   = e.length ? e : $(e.target);
                var output = list.data('output');

                output.val(window.JSON ? window.JSON.stringify(list.nestable('serialize')) :
                    'JSON browser support required for this demo.');
            };
            $('#nestable').nestable({ group: 1,maxDepth: 3 }).on('change', updateOutput);
            updateOutput($('#nestable').data('output', $('#nestable-output')));
        });
    </script>
@endsection
@section('modal-validation')
    {!!  makeValidation('serialization-form',route($entity.'.store-serialization'), "tableReload(); closeModal();") !!}
@endsection
