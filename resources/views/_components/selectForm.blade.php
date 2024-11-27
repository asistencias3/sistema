<div class="w-full px-3">
    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="{{$label_for}}">
        {{$label_content}}
    </label>
    <select name="{{$input_name}}" id="{{$input_id}}">
        <option value="">Seleccionar una opción</option>
        {{$content}}
    </select>
</div>