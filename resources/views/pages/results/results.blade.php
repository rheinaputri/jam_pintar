@extends('layouts.app')

@section('title', 'Hasil Rekomendasi - SmartPeak')

@section('content')
<div class="result-page">
    <div class="container py-5">

        {{-- Header --}}
        <div class="text-center mb-5">
            <div class="success-icon mx-auto mb-4">
                <svg width="42" height="42" viewBox="0 0 24 24" fill="none">
                    <path d="M20 6L9 17L4 12" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <h1 class="fw-bold result-title mb-3">
                Hasil Rekomendasi Belajarmu
            </h1>

            <p class="result-subtitle">
                Berdasarkan jawaban yang telah kamu isi, berikut waktu belajar yang paling sesuai untukmu.
            </p>
        </div>

        {{-- Main Card --}}
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="result-card">

                    {{-- Preferred Study Time --}}
                    <div class="study-time-badge mb-4">
                        {{ ucfirst($result->recommendation->prefered_study_time) }}
                    </div>

                    {{-- Recommendation --}}
                    <div class="recommendation-section mb-4">
                        <h5 class="section-title">
                            Rekomendasi Belajar
                        </h5>

                        <p class="recommendation-text">
                            {{ $result->recommendation->recomendation }}
                        </p>
                    </div>

                    {{-- Study Time --}}
                    <div class="row g-4">

                        {{-- Main Study Time --}}
                        <div class="col-md-6">
                            <div class="time-card">
                                <div class="time-icon">
                                    ⏰
                                </div>

                                <h6 class="time-title">
                                    Jam Belajar Utama
                                </h6>

                                <p class="time-value">
                                    {{ \Carbon\Carbon::parse($result->recommendation->study_hour_start)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($result->recommendation->study_hour_end)->format('H:i') }}
                                </p>
                            </div>
                        </div>

                        {{-- Alternative Study Time --}}
                        <div class="col-md-6">
                            <div class="time-card secondary">
                                <div class="time-icon">
                                    🌙
                                </div>

                                <h6 class="time-title">
                                    Jam Alternatif
                                </h6>

                                <p class="time-value">
                                    {{ \Carbon\Carbon::parse($result->recommendation->alt_study_hour_start)->format('H:i') }}
                                    -
                                    {{ \Carbon\Carbon::parse($result->recommendation->alt_study_hour_end)->format('H:i') }}
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- Footer --}}
                    <div class="text-center mt-5">
                        <a href="#" class="btn-download">
                            Download Hasil PDF
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .result-page {
        min-height: 100vh;
        background: #F9FAFB;
    }

    .success-icon {
        width: 85px;
        height: 85px;
        background: #F4B400;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(244, 180, 0, 0.25);
    }

    .result-title {
        font-size: 2.2rem;
        color: #1F2937;
    }

    .result-subtitle {
        color: #6B7280;
        font-size: 1rem;
        max-width: 600px;
        margin: auto;
        line-height: 1.7;
    }

    .result-card {
        background: white;
        border-radius: 28px;
        padding: 50px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.06);
    }

    .study-time-badge {
        display: inline-block;
        background: #F4B400;
        color: #1F2937;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 12px 28px;
        border-radius: 999px;
    }

    .section-title {
        color: #1F2937;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .recommendation-text {
        color: #4B5563;
        line-height: 1.9;
        font-size: 1rem;
    }

    .time-card {
        background: #F9FAFB;
        border-radius: 20px;
        padding: 28px;
        text-align: center;
        height: 100%;
        border: 1px solid #E5E7EB;
        transition: 0.3s ease;
    }

    .time-card:hover {
        transform: translateY(-3px);
    }

    .time-card.secondary {
        background: #FFF9E8;
    }

    .time-icon {
        font-size: 2rem;
        margin-bottom: 12px;
    }

    .time-title {
        color: #6B7280;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .time-value {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1F2937;
        margin: 0;
    }

    .btn-download {
        background: #1F2937;
        color: white;
        text-decoration: none;
        padding: 14px 28px;
        border-radius: 14px;
        font-weight: 600;
        transition: 0.3s ease;
        display: inline-block;
    }

    .btn-download:hover {
        background: #111827;
        color: white;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .result-card {
            padding: 30px 24px;
        }

        .result-title {
            font-size: 1.7rem;
        }

        .time-value {
            font-size: 1.1rem;
        }
    }
</style>
@endsection