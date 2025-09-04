@props(['name' => 'name', 'value' =>'value', 'label' => ''])
<label class="label block">{{$label}}</label>
<input {{$attributes}} class="input" name="{{$name}}"
       value="{{ $value === 'value' ? old($name) : $value }}"/>
<span class="text-red-500">{{ implode($errors->get($name)) }}</span>
