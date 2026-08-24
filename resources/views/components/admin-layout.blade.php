@props([
    'pageTitle' => 'Admin Panel'
])

@include('admin.layout', ['title' => $pageTitle, 'slot' => $slot])
