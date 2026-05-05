@extends('layouts.app')

@section('title', 'SmartPeak')

@section('content')

    <section class="hero-section d-flex align-items-center justify-content-center">

        <div class="container hero-wrapper text-center">
            <div class="hero-content mx-auto">

                <!-- Title -->
                <h1 class="fw-bold hero-title mb-2">
                    Kenali Jam Pintarmu
                </h1>

                <h2 class="fw-semibold hero-subtitle mb-4">
                    Tingkatkan Fokus Belajarmu
                </h2>

                <!-- Description -->
                <p class="hero-desc mb-4">
                    Temukan jam terbaik otakmu untuk belajar lebih fokus, santai, dan efektif.
                    Lewat kuis seru, kami bantu kamu kenali ritme belajarmu!
                </p>

                <!-- Button -->
                <a href="#" class="btn btn-hero px-4 py-3 rounded-pill">
                    Cari Jam Pintarku
                </a>

            </div>
        </div>

    </section>

    {{-- PROBLEM --}}
    <section class="problem-section py-5">
        <div class="container text-center">

            <h2 class="fw-semibold problem-title mb-5">
                Pernah merasa seperti ini ?
            </h2>

            <div class="d-flex justify-content-center gap-4 flex-wrap">

                {{-- CARD 1 --}}
                <div class="card problem-card">
                    <img src="{{ asset('img/pict1.png') }}" class="card-img-top problem-img">
                    <div class="card-body">
                        <h6 class="fw-bold">Belajar lama tapi zonk</h6>
                        <p class="card-text">
                            Udah berjam-jam baca buku, tapi pas ditanya rasanya hampa.
                        </p>
                    </div>
                </div>

                {{-- CARD 2 --}}
                <div class="card problem-card">
                    <img src="{{ asset('img/pict1.png') }}" class="card-img-top problem-img">
                    <div class="card-body">
                        <h6 class="fw-bold">Belajar lama tapi zonk</h6>
                        <p class="card-text">
                            Udah berjam-jam baca buku, tapi pas ditanya rasanya hampa.
                        </p>
                    </div>
                </div>

                {{-- CARD 3 --}}
                <div class="card problem-card">
                    <img src="{{ asset('img/pict1.png') }}" class="card-img-top problem-img">
                    <div class="card-body">
                        <h6 class="fw-bold">Belajar lama tapi zonk</h6>
                        <p class="card-text">
                            Udah berjam-jam baca buku, tapi pas ditanya rasanya hampa.
                        </p>
                    </div>
                </div>

                {{-- CARD 4 --}}
                <div class="card problem-card">
                    <img src="{{ asset('img/pict1.png') }}" class="card-img-top problem-img"">
                    <div class="card-body">
                        <h6 class="fw-bold">Belajar lama tapi zonk</h6>
                        <p class="card-text">
                            Udah berjam-jam baca buku, tapi pas ditanya rasanya hampa.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <style>
        .hero-section {
            min-height: 85vh;
            width: 100%;
            /* FIX */
            background: linear-gradient(180deg, #FFC83D 0%, #FFB800 100%);
            border-bottom-left-radius: 120px;
            border-bottom-right-radius: 120px;
            padding: 0;
        }

        /* wrapper biar center total */
        .hero-wrapper {
            max-width: 1000px;
            width: 100%;
        }

        /* isi konten center */
        .hero-content {
            text-align: center;
        }

        .hero-title {
            font-size: 2.4rem !important;
            color: #111 !important;
            font-weight: 800 !important;
        }

        .hero-subtitle {
            font-size: 2.4rem !important;
            color: #2A3141 !important;
            font-weight: 800 !important;
        }

        .hero-desc {
            font-size: 1rem;
            color: #2A3141;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Button */
        .btn-hero {
            background-color: #2A3141;
            color: #fff;
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .btn-hero:hover {
            background-color: #1b2230;
            transform: translateY(-2px);
            color: #fff;
        }

        /* Desktop scaling */
        @media (min-width: 1200px) {
            .hero-title {
                font-size: 3.5rem;
            }

            .hero-subtitle {
                font-size: 1.7rem;
            }
        }

        /* PROBLEM CARDS */
        .problem-title {
            font-size: 2rem !important;
            color: #2A3141 !important;
            font-weight: 800 !important;
        }

        .problem-card {
            width: 14rem;
            background: transparent;
            border: none;
        }

        .problem-img {
            display: block;
            margin: 0 auto;
            width: 60%;
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
        }

        .problem-card h6 {
            font-weight: 800;
            color: #2A3141;
        }

        .problem-card p {
            font-size: 0.9rem;
            color: #2A3141;
        }
    </style>

@endsection
