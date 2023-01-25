@php
    $seo = App\Models\Seo::first();
@endphp

<meta  charset="UTF-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta http-equiv="X-UA-Compatible" content="ie=edge" />

<meta name="csrf-token" content="{{ csrf_token() }}" />

{{-- START Seo --}}
@if (isset($seo->meta_description))
    <meta name="description" content="{{ $seo->meta_description }}">
@endif

@if (isset($seo->meta_author))
    <meta name="author" content="{{ $seo->meta_author }}">
@endif

@if (isset($seo->meta_keyword))
    <meta name="keywords" content="{{ $seo->meta_keyword }}">
@endif
{{-- END Seo --}}

