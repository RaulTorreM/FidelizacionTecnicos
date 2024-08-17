<div class ="input-select" id="{{ $idSelect }}">
	<div class="onlySelectInput-container">
        <input 
			class="{{ $inputClassName }}"
            type="text" 
            id="{{ $idInput }}" 
            placeholder="{{ $placeholder ?? 'Seleccionar opción' }}" 
            readonly 
            oninput="filterOptions('{{ $idInput }}', '{{ $idOptions }}')" 
            onclick="toggleOptions('{{ $idInput }}', '{{ $idOptions }}')" 
            autocomplete="off" 
            name="{{ $name ?? '' }}"
        >
        <span class="material-symbols-outlined" onclick="clearInput('{{ $idInput }}')"> cancel </span>
    </div>	
    <ul class="select-items" id="{{ $idOptions }}">
        @foreach ($options as $option)
            <li 
                onclick="selectOption('{{ $option }}', '{{ $idInput }}', '{{ $idOptions }}')"
            >
                {{ $option }}
            </li>
        @endforeach
    </ul>
</div>
