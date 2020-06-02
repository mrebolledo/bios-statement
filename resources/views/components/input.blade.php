<div class="form-group">
    <label class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control" name="{{ $name }}" @if($isEdit) value="{{ $value }}" @endif>
</div>
