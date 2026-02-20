<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Chart.js --}}
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @endpush

    <style>
        .dashboard-wrapper {
            padding: 1.5rem;
            font-family: 'Poppins', sans-serif;
        }

        /* ── Stat cards ─────────────────────────────────── */
        .stat-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 1.2rem 1.5rem;
            box-shadow: 0 2px 12px rgba(0,0,0,.07);
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }
        .stat-icon.blue  { background: #dbeafe; color: #2563eb; }
        .stat-icon.green { background: #dcfce7; color: #16a34a; }
        .stat-icon.amber { background: #fef3c7; color: #d97706; }
        .stat-label { font-size: .75rem; color: #6b7280; font-weight: 500; }
        .stat-value { font-size: 1.25rem; font-weight: 700; color: #111827; }

        /* ── Chart + Table Row ───────────────────────────── */
        .main-row {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .card {
            background: #fff;
            border-radius: 14px;
            padding: 1.4rem 1.6rem;
            box-shadow: 0 2px 12px rgba(0,0,0,.07);
        }
        .card-title {
            font-size: .95rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .card-title svg { width: 18px; height: 18px; }

        /* ── Top 5 Table ─────────────────────────────────── */
        .top-table {
            width: 100%;
            border-collapse: collapse;
            font-size: .82rem;
        }
        .top-table thead th {
            text-align: left;
            padding: .5rem .6rem;
            color: #6b7280;
            font-weight: 600;
            border-bottom: 2px solid #f3f4f6;
        }
        .top-table tbody td {
            padding: .55rem .6rem;
            color: #374151;
            border-bottom: 1px solid #f9fafb;
            vertical-align: middle;
        }
        .top-table tbody tr:last-child td { border-bottom: none; }
        .rank-badge {
            width: 24px; height: 24px;
            border-radius: 50%;
            background: #e0e7ff;
            color: #4338ca;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: .72rem; font-weight: 700;
        }
        .rank-badge.gold   { background: #fef3c7; color: #92400e; }
        .rank-badge.silver { background: #e5e7eb; color: #374151; }
        .rank-badge.bronze { background: #fde8d8; color: #9a3412; }
        .amount-pill {
            background: #d1fae5;
            color: #065f46;
            padding: .18rem .55rem;
            border-radius: 999px;
            font-size: .74rem;
            font-weight: 600;
            white-space: nowrap;
        }
        .donation-name {
            max-width: 180px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* ── Menu Buttons ─────────────────────────────────── */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
        .menu-btn {
            background: #fff;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            padding: 1.6rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: .7rem;
            text-decoration: none;
            color: #374151;
            font-weight: 600;
            font-size: .9rem;
            transition: all .2s ease;
            box-shadow: 0 1px 4px rgba(0,0,0,.05);
        }
        .menu-btn:hover {
            border-color: #6366f1;
            background: #eef2ff;
            color: #4338ca;
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(99,102,241,.15);
        }
        .menu-btn .menu-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            transition: background .2s;
        }
        .menu-btn:hover .menu-icon { filter: brightness(1.08); }

        .icon-donation   { background: #dbeafe; }
        .icon-donatur    { background: #dcfce7; }
        .icon-doc        { background: #fef3c7; }
        .icon-news       { background: #fce7f3; }
        .icon-release    { background: #ede9fe; }
        .icon-service    { background: #ffedd5; }

        @media (max-width: 900px) {
            .main-row { grid-template-columns: 1fr; }
            .stat-cards { grid-template-columns: repeat(2, 1fr); }
            .menu-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 560px) {
            .stat-cards { grid-template-columns: 1fr; }
            .menu-grid { grid-template-columns: 1fr; }
        }
    </style>

    <div class="dashboard-wrapper">

        {{-- ── Stat Summary Cards ────────────────────────── --}}
        <div class="stat-cards">
            <div class="stat-card">
                <div class="stat-icon green">💰</div>
                <div>
                    <div class="stat-label">Total Terkumpul</div>
                    <div class="stat-value">Rp {{ number_format($totalCollected, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue">👥</div>
                <div>
                    <div class="stat-label">Total Donatur</div>
                    <div class="stat-value">{{ number_format($totalDonatur) }}</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon amber">📋</div>
                <div>
                    <div class="stat-label">Total Campaign</div>
                    <div class="stat-value">{{ number_format($totalCampaign) }}</div>
                </div>
            </div>
        </div>

        {{-- ── Chart + Top 5 Table ───────────────────────── --}}
        <div class="main-row">

            {{-- Chart --}}
            <div class="card">
                <div class="card-title">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 17l4-8 4 4 4-6 4 5"/>
                    </svg>
                    Donasi Per Bulan ({{ now()->year }})
                </div>
                <canvas id="donationChart" height="200"></canvas>
            </div>

            {{-- Top 5 Table --}}
            <div class="card">
                <div class="card-title">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm4 8l2 2 4-4"/>
                    </svg>
                    Top 5 Donasi Terbesar
                </div>

                @if($topDonations->isEmpty())
                    <p class="text-center text-gray-400 text-sm py-6">Belum ada data donasi.</p>
                @else
                <table class="top-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kampanye</th>
                            <th>Terkumpul</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topDonations as $i => $donation)
                        <tr>
                            <td>
                                @php
                                    $badgeClass = match($i) {
                                        0 => 'gold',
                                        1 => 'silver',
                                        2 => 'bronze',
                                        default => ''
                                    };
                                @endphp
                                <span class="rank-badge {{ $badgeClass }}">{{ $i + 1 }}</span>
                            </td>
                            <td>
                                <div class="donation-name" title="{{ $donation->name }}">
                                    {{ $donation->name }}
                                </div>
                            </td>
                            <td>
                                <span class="amount-pill">
                                    Rp {{ number_format($donation->total_collected ?? 0, 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>

        {{-- ── Quick Menu Buttons (2 rows × 3 cols) ────────── --}}
        <div class="card" style="padding-bottom: 1.8rem;">
            <div class="card-title">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                Menu
            </div>

            <div class="menu-grid">
                {{-- Donation --}}
                <a href="{{ route('admin.donations.index') }}" class="menu-btn">
                    <div class="menu-icon icon-donation">💳</div>
                    <span>Donasi</span>
                </a>

                {{-- Donatur --}}
                <a href="{{ route('admin.donaturs.index') }}" class="menu-btn">
                    <div class="menu-icon icon-donatur">🤝</div>
                    <span>Donatur</span>
                </a>

                {{-- Documentation --}}
                <a href="{{ route('admin.documentations.index') }}" class="menu-btn">
                    <div class="menu-icon icon-doc">📂</div>
                    <span>Dokumentasi</span>
                </a>

                {{-- News (Articles) --}}
                <a href="{{ route('admin.articles.index') }}" class="menu-btn">
                    <div class="menu-icon icon-news">📰</div>
                    <span>Berita</span>
                </a>

                {{-- Releases --}}
                <a href="{{ route('admin.releases.index') }}" class="menu-btn">
                    <div class="menu-icon icon-release">📦</div>
                    <span>Releases</span>
                </a>

                {{-- Customer Service --}}
                <a href="{{ route('admin.services.index') }}" class="menu-btn">
                    <div class="menu-icon icon-service">🎧</div>
                    <span>Customer Service</span>
                </a>
            </div>
        </div>

    </div>

    {{-- Chart.js script (inline so it works without @stack) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('donationChart').getContext('2d');

            const labels = @json($chartLabels->values());
            const data   = @json($chartData->values());

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Donasi (Rp)',
                        data: data,
                        backgroundColor: 'rgba(99, 102, 241, 0.15)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        borderWidth: 2,
                        borderRadius: 8,
                        hoverBackgroundColor: 'rgba(99, 102, 241, 0.35)',
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: ctx => 'Rp ' + ctx.raw.toLocaleString('id-ID')
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: v => 'Rp ' + (v >= 1000000
                                    ? (v/1000000).toFixed(1) + 'jt'
                                    : v.toLocaleString('id-ID')),
                                font: { size: 11 }
                            },
                            grid: { color: '#f3f4f6' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 11 } }
                        }
                    }
                }
            });
        });
    </script>

</x-app-layout>
