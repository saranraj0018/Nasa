@props([
    'name' => 'batch',
    'id' => 'batch',
    'selected' => null,
    'placeholder' => 'Select Batch',
])
@php
    $batchOptions = \App\Models\Batch::options();
    // Keep a record's saved batch visible even if it has since been deactivated.
    if (filled($selected) && !$batchOptions->contains($selected)) {
        $batchOptions = $batchOptions->push($selected)->sort()->values();
    }
@endphp
<select name="{{ $name }}" @if ($id) id="{{ $id }}" @endif {{ $attributes }}>
    <option value="">{{ $placeholder }}</option>
    @foreach ($batchOptions as $batchName)
        <option value="{{ $batchName }}" @selected((string) $selected === (string) $batchName)>{{ $batchName }}</option>
    @endforeach
</select>
