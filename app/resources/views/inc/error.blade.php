@error($field_name)
<div class="text-danger error" style="{{isset($style) ? $style : ''}}">
   {{ $message }}
</div>
@enderror
