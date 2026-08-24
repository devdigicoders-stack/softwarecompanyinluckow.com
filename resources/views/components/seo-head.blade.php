@props([
    'title' => null,
    'description' => null,
    'canonical' => null,
    'keywords' => null,
    'ogImage' => null,
    'ogType' => 'website',
    'robots' => 'index, follow',
])

@php
    $defaultMeta = \App\Services\SeoHelper::defaultMeta();
    $metaTitle = $title ? $title : $defaultMeta['title'];
    $metaDesc = $description ? $description : $defaultMeta['description'];
    $canonicalUrl = $canonical ? $canonical : $defaultMeta['canonical'];
    $metaKeywords = $keywords ? $keywords : $defaultMeta['keywords'];
    $image = $ogImage ? $ogImage : $defaultMeta['og_image'];
@endphp

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $metaDesc }}">
<meta name="keywords" content="{{ $metaKeywords }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonicalUrl }}">

<!-- OpenGraph / Facebook Tags -->
<meta property="og:type" content="{{ $ogType }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDesc }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:site_name" content="Software Company in Lucknow">

<!-- Twitter / X Card Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $canonicalUrl }}">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDesc }}">
<meta name="twitter:image" content="{{ $image }}">

<!-- Favicon Icons -->
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">

