@php
    $api = request()->is('api') || request()->is('api/*');

    if (site_setting('maintenance_enabled') && !session()->has('maintenance_password')) {
        if (!$api) {
            exit(header('Location: ' . route('maintenance.index')));
        } else {
            header('Content-Type: application/json');
            exit(json_encode([
                'error' => [
                    'message' => 'Maintenance is currently enabled',
                    'prettyMessage' => 'Maintenance is currently enabled'
                ]
            ]));
        }
    } else if ($api) {
        header('Content-Type: application/json');
        exit(json_encode([
            'error' => [
                'message' => 'Page not found',
                'prettyMessage' => 'Sorry, something went wrong'
            ]
        ]));
    }
@endphp

@extends('layouts.default', [
    'title' => $title
])

@section('content')
    <div style="text-align:center;padding-top:50px;">
        <span style="font-weight:600;font-size:3rem;display:block;">Error {{ $code }}: {{ $title }}</span>
        @if (isset($description))
            <span style="font-weight:500;font-size:2rem;display:block;padding-bottom:20px;">{{ $description }}</span>
        @endif
    </div>
@endsection
