<label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="{{ $id }}">
  {{ $label }}
</label>
<textarea class="appearance-none block w-full bg-white-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-grey focus:border-gray-500" id="{{ $id }}" name="{{ $id }}" type="text" value="{{ $value ?? '' }}"></textarea>