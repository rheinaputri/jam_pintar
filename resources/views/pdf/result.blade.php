

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Rekomendasi Belajar - SmartPeak</title>

    <style>
        * {
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #F9FAFB;
            color: #1F2937;
        }

        .container {
            padding: 40px;
        }

        /* HEADER */
        .header {
            background: #F4B400;
            color: #1F2937;
            padding: 30px;
            border-radius: 18px;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .header-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .header-subtitle {
            font-size: 14px;
            line-height: 1.7;
        }

        /* CARD */
        .card {
            background: #FFFFFF;
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 24px;
            border: 1px solid #E5E7EB;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 14px;
            color: #111827;
        }

        /* STUDY BADGE */
        .study-badge {
            display: inline-block;
            background: #FFF4D6;
            color: #B7791F;
            padding: 10px 18px;
            border-radius: 999px;
            font-size: 15px;
            font-weight: bold;
            margin-top: 10px;
        }

        /* RECOMMENDATION */
        .recommendation-text {
            font-size: 14px;
            line-height: 1.9;
            color: #374151;
            text-align: justify;
        }

        /* TIME BOX */
        .time-wrapper {
            margin-top: 10px;
        }

        .time-box {
            width: 48%;
            display: inline-block;
            vertical-align: top;
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            border-radius: 14px;
            padding: 20px;
        }

        .time-box.right {
            float: right;
        }

        .time-label {
            font-size: 13px;
            color: #6B7280;
            margin-bottom: 10px;
        }

        .time-value {
            font-size: 20px;
            font-weight: bold;
            color: #111827;
        }

        /* FOOTER */
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #9CA3AF;
        }

        .divider {
            margin: 25px 0;
            border-top: 1px solid #E5E7EB;
        }

    </style>
</head>
<body>

    <div class="container">

        {{-- HEADER --}}
        <div class="header">
            <div class="logo">
                SMARTPEAK
            </div>

            <div class="header-title">
                Hasil Rekomendasi Belajar
            </div>

            <div class="header-subtitle">
                Dokumen ini berisi hasil rekomendasi waktu belajar berdasarkan
                jawaban kuisioner yang telah diisi pada sistem SmartPeak.
            </div>
        </div>

        {{-- PREFERRED STUDY TIME --}}
        <div class="card">
            <div class="section-title">
                Preferred Study Time
            </div>

            <div class="study-badge">
                {{ strtoupper($result->recommendation->preferred_study_time ?? $result->recommendation->prefered_study_time) }}
            </div>
        </div>

        {{-- RECOMMENDATION --}}
        <div class="card">
            <div class="section-title">
                Rekomendasi Belajar
            </div>

            <div class="recommendation-text">
                {{ $result->recommendation->recomendation }}
            </div>
        </div>

        {{-- STUDY HOURS --}}
        <div class="card">

            <div class="section-title">
                Waktu Belajar yang Disarankan
            </div>

            <div class="time-wrapper">

                {{-- MAIN TIME --}}
                <div class="time-box">

                    <div class="time-label">
                        Jam Belajar Utama
                    </div>

                    <div class="time-value">
                        {{ \Carbon\Carbon::parse($result->recommendation->study_hour_start)->format('H:i') }}
                        -
                        {{ \Carbon\Carbon::parse($result->recommendation->study_hour_end)->format('H:i') }}
                    </div>

                </div>

                {{-- ALT TIME --}}
                <div class="time-box right">

                    <div class="time-label">
                        Jam Alternatif
                    </div>

                    <div class="time-value">

                        @if($result->recommendation->alt_study_hour_start && $result->recommendation->alt_study_hour_end)

                            {{ \Carbon\Carbon::parse($result->recommendation->alt_study_hour_start)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($result->recommendation->alt_study_hour_end)->format('H:i') }}

                        @else
                            -
                        @endif

                    </div>

                </div>

            </div>

            <div style="clear: both;"></div>

        </div>

        {{-- FOOTER --}}
        <div class="footer">

            <div class="divider"></div>

            Generated automatically by SmartPeak<br>
            © {{ date('Y') }} SmartPeak Learning Recommendation System

        </div>

    </div>

</body>
</html>