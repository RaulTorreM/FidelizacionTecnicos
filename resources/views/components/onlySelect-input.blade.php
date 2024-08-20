@php
    $uniqueId = uniqid();
    $dynamicIdInput = $idInput ?? 'input-' . $uniqueId;
    $dynamicIdOptions = $idOptions ?? 'options-' . $uniqueId;
    $isDisabled = $disabled ?? false;
    $spanOwnClassName = $spanClassName ?? ''; // Asignar un valor por defecto si $spanClassName no está definido
    $focusBorder = $focusBorder ?? '';
@endphp

<div class ="input-select">
    <div class="onlySelectInput-container {{$focusBorder}}">
        <input 
            class="{{ $inputClassName }}"
            type="text" 
            id="{{ $dynamicIdInput }}" 
            placeholder="{{ $placeholder ?? 'Seleccionar opción' }}" 
            oninput="filterOptions('{{ $dynamicIdInput }}', '{{ $dynamicIdOptions }}')" 
            onclick="toggleOptions('{{ $dynamicIdInput }}', '{{ $dynamicIdOptions }}')" 
            autocomplete="off" 
            readonly
            name="{{ $name ?? '' }}"
            {{ $isDisabled ? 'disabled' : '' }}
        >
        <span class="material-symbols-outlined {{ $spanOwnClassName }}" 
              onclick="{{ $isDisabled ? '' : "clearInput('{$dynamicIdInput}')" }}"> cancel </span>
    </div>  
    <ul class="select-items" id="{{ $dynamicIdOptions }}">
        @foreach ($options as $option)
            <li 
                onclick="selectOption('{{ $option }}', '{{ $dynamicIdInput }}', '{{ $dynamicIdOptions }}')"
            >
                {{ $option }}
            </li>
        @endforeach
    </ul>
</div>
