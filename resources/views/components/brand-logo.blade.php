@props(['dark' => false, 'size' => 'md'])

@php
    $textColor = $dark ? '#FFFFFF' : '#0A0F0B';
    $greenColor = '#5EA83A';
    $height = match($size) {
        'sm' => 'h-10',
        'lg' => 'h-20',
        default => 'h-14',
    };
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center select-none']) }}>
    <svg class="{{ $height }} w-auto" viewBox="0 0 340 130" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="SDS 26 Green IoT - ASEIS">
        <!-- Ondas WiFi / IoT -->
        <path d="M54 22C65 13 83 13 94 22" stroke="{{ $greenColor }}" stroke-width="4.5" stroke-linecap="round"/>
        <path d="M61 30C69 24 79 24 87 30" stroke="{{ $greenColor }}" stroke-width="4.5" stroke-linecap="round"/>
        <circle cx="74" cy="37" r="3.5" fill="{{ $greenColor }}"/>

        <!-- Barras verticales laterales con nodos -->
        <line x1="22" y1="42" x2="22" y2="96" stroke="{{ $textColor }}" stroke-width="3"/>
        <rect x="19" y="39" width="6" height="6" fill="{{ $textColor }}"/>
        <rect x="19" y="93" width="6" height="6" fill="{{ $textColor }}"/>

        <line x1="126" y1="42" x2="126" y2="96" stroke="{{ $textColor }}" stroke-width="3"/>
        <rect x="123" y="39" width="6" height="6" fill="{{ $textColor }}"/>
        <rect x="123" y="93" width="6" height="6" fill="{{ $textColor }}"/>

        <!-- Texto SDS -->
        <text x="74" y="64" text-anchor="middle" fill="{{ $textColor }}" font-family="system-ui, -apple-system, sans-serif" font-weight="900" font-size="31" letter-spacing="1">SDS</text>

        <!-- Número 26 -->
        <text x="74" y="96" text-anchor="middle" fill="{{ $greenColor }}" font-family="system-ui, -apple-system, sans-serif" font-weight="900" font-size="36" letter-spacing="-1">26</text>

        <!-- Texto GREEN IoT -->
        <text x="54" y="114" text-anchor="middle" fill="{{ $greenColor }}" font-family="system-ui, -apple-system, sans-serif" font-weight="800" font-size="13.5" letter-spacing="0.5">GREEN</text>
        <text x="103" y="114" text-anchor="middle" fill="{{ $textColor }}" font-family="system-ui, -apple-system, sans-serif" font-weight="800" font-size="13.5" letter-spacing="0.5">IOT</text>

        <!-- Línea divisoria verde -->
        <line x1="158" y1="16" x2="158" y2="114" stroke="{{ $greenColor }}" stroke-width="3.5" stroke-linecap="round"/>

        <!-- Emblema Circular ASEIS -->
        <g transform="translate(232, 68)">
            <!-- Arco circular abierto arriba -->
            <path d="M-24 -28 A 37 37 0 1 0 24 -28" stroke="{{ $textColor }}" stroke-width="4.5" stroke-linecap="round" fill="none"/>
            <!-- Silueta Minerva -->
            <path d="M-6 -44 C-2 -48 6 -47 8 -41 C10 -37 8 -33 10 -29 C13 -27 14 -23 10 -20 C8 -16 6 -11 0 -10 C-6 -10 -10 -14 -10 -19 C-10 -23 -13 -25 -13 -28 C-13 -30 -10 -32 -10 -36 C-10 -40 -9 -42 -6 -44 Z" fill="{{ $textColor }}"/>
            <!-- Texto ASEIS -->
            <text x="0" y="10" text-anchor="middle" fill="{{ $textColor }}" font-family="system-ui, -apple-system, sans-serif" font-weight="900" font-size="16.5" letter-spacing="0.8">ASEIS</text>
        </g>
    </svg>
</div>