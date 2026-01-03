@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- ===== TOP 3 STAT CARDS ===== --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    @include('layouts.partials.stat-mini-card', [
        'title' => 'Statistics',
        'label' => 'Realtime users',
        'value' => $realtimeUsers,
        'delta' => '+21.0%',
        'deltaUp' => true,
    ])

    @include('layouts.partials.stat-mini-card', [
        'title' => 'Statistics',
        'label' => 'Total visits',
        'value' => $totalVisits,
        'delta' => '+18.34%',
        'deltaUp' => true,
    ])

    @include('layouts.partials.stat-mini-card', [
        'title' => 'Statistics',
        'label' => 'Visit duration',
        'value' => gmdate('i\m s\s', $avgSeconds),
        'delta' => '-2.86%',
        'deltaUp' => false,
    ])
</div>

{{-- ===== BOTTOM 2 BIG CARDS ===== --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
    @include('layouts.partials.chart-card', [
        'title' => 'Active users',
        'subtitle' => $activeUsers7d,
        'rightNote' => 'last 7 days',
    ])

    @include('layouts.partials.signup-card', [
        'value' => $signups30d,
    ])
</div>

@endsection
