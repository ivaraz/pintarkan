<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Transkrip Nilai - {{ $student->name }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            color: #1e293b;
            background: #fff;
            line-height: 1.6;
        }

        /* ═══════════════════════════════════════════════════
           KOP SURAT / LETTERHEAD
        ═══════════════════════════════════════════════════ */
        .letterhead {
            padding: 20px 40px 0 40px;
        }

        .letterhead-inner {
            display: table;
            width: 100%;
            border-bottom: 3px solid #1e293b;
            padding-bottom: 12px;
        }

        .letterhead-logo {
            display: table-cell;
            width: 64px;
            vertical-align: middle;
        }

        .letterhead-logo img {
            width: 52px;
            height: 52px;
            display: block;
        }

        .letterhead-info {
            display: table-cell;
            vertical-align: middle;
            padding-left: 14px;
        }

        .letterhead-info .platform-name {
            font-size: 20px;
            font-weight: 900;
            color: #1e293b;
            letter-spacing: -0.5px;
            line-height: 1.1;
        }

        .letterhead-info .platform-name span {
            color: #4f46e5;
        }

        .letterhead-info .platform-tagline {
            font-size: 10px;
            color: #64748b;
            margin-top: 2px;
            font-style: italic;
        }

        .letterhead-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 200px;
        }

        .letterhead-right .doc-type {
            font-size: 10px;
            font-weight: 700;
            color: #4f46e5;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            border: 1px solid #4f46e5;
            display: inline-block;
            padding: 3px 10px;
            border-radius: 4px;
        }

        .letterhead-right .doc-date {
            font-size: 9px;
            color: #94a3b8;
            margin-top: 6px;
        }

        /* ═══════════════════════════════════════════════════
           PLATFORM INFO BAR
        ═══════════════════════════════════════════════════ */
        .platform-bar {
            background: #f1f5f9;
            padding: 6px 40px;
            display: table;
            width: 100%;
        }

        .platform-bar-item {
            display: table-cell;
            font-size: 9px;
            color: #475569;
            padding-right: 20px;
        }

        .platform-bar-item strong {
            color: #1e293b;
        }

        /* ═══════════════════════════════════════════════════
           DOCUMENT TITLE
        ═══════════════════════════════════════════════════ */
        .doc-title-block {
            text-align: center;
            padding: 18px 40px 10px 40px;
        }

        .doc-title-block h1 {
            font-size: 15px;
            font-weight: 900;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .doc-title-block .doc-subtitle {
            font-size: 11px;
            color: #64748b;
            margin-top: 2px;
        }

        /* ═══════════════════════════════════════════════════
           STUDENT IDENTITY CARD
        ═══════════════════════════════════════════════════ */
        .identity-section {
            margin: 16px 40px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            overflow: hidden;
        }

        .identity-header {
            background: #1e293b;
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 6px 14px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .identity-body {
            display: table;
            width: 100%;
            padding: 12px 14px;
            background: #f8fafc;
        }

        .identity-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .identity-row {
            display: table;
            width: 100%;
            margin-bottom: 6px;
        }

        .id-label {
            display: table-cell;
            width: 130px;
            font-size: 10px;
            color: #64748b;
            vertical-align: top;
        }

        .id-colon {
            display: table-cell;
            width: 10px;
            font-size: 10px;
            color: #64748b;
        }

        .id-value {
            display: table-cell;
            font-size: 10px;
            font-weight: 700;
            color: #0f172a;
        }

        /* ═══════════════════════════════════════════════════
           GRADE TABLE
        ═══════════════════════════════════════════════════ */
        .table-section {
            margin: 16px 40px;
        }

        .table-section-title {
            font-size: 11px;
            font-weight: 800;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 8px;
            padding-left: 2px;
        }

        table.grade-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #cbd5e1;
        }

        table.grade-table thead tr {
            background: #1e293b;
        }

        table.grade-table thead th {
            padding: 9px 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #e2e8f0;
            text-align: left;
            border: none;
        }

        table.grade-table thead th.center {
            text-align: center;
        }

        table.grade-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        table.grade-table tbody tr:nth-child(odd) {
            background: #ffffff;
        }

        table.grade-table tbody td {
            padding: 9px 12px;
            font-size: 10px;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        table.grade-table tbody td.center {
            text-align: center;
        }

        table.grade-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Nilai & Predikat badges */
        .grade-final {
            font-size: 15px;
            font-weight: 900;
            display: block;
        }

        .grade-a {
            color: #059669;
        }

        .grade-b {
            color: #2563eb;
        }

        .grade-c {
            color: #d97706;
        }

        .grade-d {
            color: #dc2626;
        }

        .grade-e {
            color: #7c3aed;
        }

        .grade-na {
            color: #94a3b8;
        }

        .predikat-badge {
            display: inline-block;
            font-weight: 800;
            font-size: 15px;
            width: 32px;
            height: 32px;
            line-height: 32px;
            text-align: center;
            border-radius: 6px;
        }

        .predikat-a {
            background: #dcfce7;
            color: #166534;
        }

        .predikat-b {
            background: #dbeafe;
            color: #1e40af;
        }

        .predikat-c {
            background: #fef3c7;
            color: #92400e;
        }

        .predikat-d {
            background: #fee2e2;
            color: #991b1b;
        }

        .predikat-e {
            background: #f3e8ff;
            color: #6b21a8;
        }

        .predikat-na {
            background: #f1f5f9;
            color: #94a3b8;
        }

        .no-data {
            color: #94a3b8;
            font-style: italic;
        }

        /* Total row */
        .total-row td {
            background: #1e293b !important;
            color: #e2e8f0 !important;
            font-weight: 700;
            border-bottom: none !important;
        }

        .total-row td .grade-final {
            color: #a5f3fc !important;
        }

        .total-row td .predikat-badge {
            background: rgba(255, 255, 255, 0.15) !important;
            color: #fff !important;
        }

        /* ═══════════════════════════════════════════════════
           GRADING LEGEND
        ═══════════════════════════════════════════════════ */
        .legend {
            margin: 0 40px 16px 40px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 10px 14px;
        }

        .legend-title {
            font-size: 9px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .legend-grid {
            display: table;
            width: 100%;
        }

        .legend-item {
            display: table-cell;
            font-size: 9px;
            color: #475569;
            padding-right: 8px;
        }

        .legend-item strong {
            color: #1e293b;
        }

        /* ═══════════════════════════════════════════════════
           FOOTER / SIGNATURE
        ═══════════════════════════════════════════════════ */
        .doc-footer {
            margin: 20px 40px 0 40px;
            padding-top: 12px;
            border-top: 2px solid #1e293b;
            display: table;
            width: calc(100% - 80px);
        }

        .footer-left-cell,
        .footer-right-cell {
            display: table-cell;
            vertical-align: bottom;
        }

        .footer-right-cell {
            text-align: right;
        }

        .footer-note {
            font-size: 9px;
            color: #94a3b8;
            line-height: 1.6;
        }

        .footer-note strong {
            color: #475569;
        }

        .sign-label {
            font-size: 10px;
            color: #475569;
        }

        .sign-gap {
            margin-top: 44px;
            margin-bottom: 2px;
            border-bottom: 1px solid #475569;
            width: 160px;
            display: inline-block;
        }

        .sign-name {
            font-size: 11px;
            font-weight: 800;
            color: #1e293b;
            margin-top: 3px;
        }

        .sign-nidn {
            font-size: 9px;
            color: #64748b;
        }

        .sign-title {
            font-size: 9px;
            color: #64748b;
        }

        .watermark {
            position: fixed;
            bottom: 80px;
            right: 40px;
            font-size: 48px;
            font-weight: 900;
            color: rgba(79, 70, 229, 0.06);
            letter-spacing: -2px;
            transform: rotate(-25deg);
            transform-origin: right bottom;
        }
    </style>
</head>

<body>

    {{-- ════════════════════════════════════════════════════
         WATERMARK
    ════════════════════════════════════════════════════ --}}
    <div class="watermark">PintarKan</div>

    {{-- ════════════════════════════════════════════════════
         KOP SURAT / LETTERHEAD
    ════════════════════════════════════════════════════ --}}
    <div class="letterhead">
        <div class="letterhead-inner">

            {{-- Logo --}}
            <div class="letterhead-logo">
                <img src="{{ public_path('img/PintarKan.png') }}" alt="PintarKan">
            </div>

            {{-- Platform Identity --}}
            <div class="letterhead-info">
                <div class="platform-name">Pintar<span>Kan</span></div>
                <div class="platform-tagline">Learning Management System &mdash; Platform Akademik Digital</div>
            </div>

            {{-- Document Type --}}
            <div class="letterhead-right">
                <div class="doc-type">Dokumen Resmi</div>
                <div class="doc-date">Diterbitkan: {{ now()->format('d F Y') }}</div>
            </div>

        </div>
    </div>

    {{-- ════════════════════════════════════════════════════
         DOCUMENT TITLE
    ════════════════════════════════════════════════════ --}}
    <div class="doc-title-block">
        <h1>Transkrip Nilai Akhir Mahasiswa</h1>
        <div class="doc-subtitle">Rekapitulasi Nilai Akhir &amp; Predikat Per Mata Kuliah</div>
    </div>

    {{-- ════════════════════════════════════════════════════
         STUDENT IDENTITY
    ════════════════════════════════════════════════════ --}}
    <div class="identity-section">
        <div class="identity-header">&#9632; Identitas Mahasiswa</div>
        <div class="identity-body">
            <div class="identity-col">
                <div class="identity-row">
                    <div class="id-label">Nama Mahasiswa</div>
                    <div class="id-colon">:</div>
                    <div class="id-value">{{ $student->name }}</div>
                </div>
                <div class="identity-row">
                    <div class="id-label">NPM</div>
                    <div class="id-colon">:</div>
                    <div class="id-value">{{ $student->npm ?? '-' }}</div>
                </div>
                <div class="identity-row">
                    <div class="id-label">Email</div>
                    <div class="id-colon">:</div>
                    <div class="id-value">{{ $student->user->email ?? '-' }}</div>
                </div>
            </div>
            <div class="identity-col">
                <div class="identity-row">
                    <div class="id-label">Dosen Pembina</div>
                    <div class="id-colon">:</div>
                    <div class="id-value">{{ $lecturer->name ?? '-' }}</div>
                </div>
                @if (!empty($lecturer->nidn))
                    <div class="identity-row">
                        <div class="id-label">NIDN Dosen</div>
                        <div class="id-colon">:</div>
                        <div class="id-value">{{ $lecturer->nidn }}</div>
                    </div>
                @endif
                <div class="identity-row">
                    <div class="id-label">Tanggal Cetak</div>
                    <div class="id-colon">:</div>
                    <div class="id-value">{{ now()->format('d F Y, H:i') }} WIB</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════
         REKAP NILAI AKHIR — hanya nilai akhir & predikat
    ════════════════════════════════════════════════════ --}}
    @php
        /**
         * Sistem Penilaian (skala 0–100%):
         *   A  (Sangat Baik) : >= 85%
         *   B  (Baik)        : 70% – 84%
         *   C  (Cukup)       : 55% – 69%
         *   D  (Kurang)      : 40% – 54%
         *   E  (Gagal)       : <  40%
         */
        function getPredikat(float|null $pct): array
        {
            if ($pct === null) {
                return ['huruf' => '-', 'label' => 'Belum Ada Nilai', 'class' => 'na'];
            }
            if ($pct >= 85) {
                return ['huruf' => 'A', 'label' => 'Sangat Baik', 'class' => 'a'];
            }
            if ($pct >= 70) {
                return ['huruf' => 'B', 'label' => 'Baik', 'class' => 'b'];
            }
            if ($pct >= 55) {
                return ['huruf' => 'C', 'label' => 'Cukup', 'class' => 'c'];
            }
            if ($pct >= 40) {
                return ['huruf' => 'D', 'label' => 'Kurang', 'class' => 'd'];
            }
            return ['huruf' => 'E', 'label' => 'Gagal', 'class' => 'e'];
        }

        $overallPredikat = getPredikat($overall_average);
    @endphp

    <div class="table-section">
        <div class="table-section-title">Rekap Nilai Akhir Per Mata Kuliah</div>
        <table class="grade-table">
            <thead>
                <tr>
                    <th style="width: 30px;">#</th>
                    <th>Mata Kuliah</th>
                    <th class="center">Jumlah Tugas</th>
                    <th class="center">Nilai Akhir (%)</th>
                    <th class="center">Predikat</th>
                    <th class="center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses_data as $index => $courseItem)
                    @php
                        $course = $courseItem['course'];
                        $courseAvg = $courseItem['course_average'];
                        $totalTugas = count($courseItem['assignments']);
                        $predikat = getPredikat($courseAvg);
                    @endphp
                    <tr>
                        <td class="center">{{ $index + 1 }}</td>
                        <td><strong>{{ $course->title }}</strong></td>
                        <td class="center">{{ $totalTugas }}</td>
                        <td class="center">
                            @if ($courseAvg !== null)
                                <span class="grade-final grade-{{ $predikat['class'] }}">
                                    {{ number_format($courseAvg, 1) }}
                                </span>
                            @else
                                <span class="no-data">-</span>
                            @endif
                        </td>
                        <td class="center">
                            <span class="predikat-badge predikat-{{ $predikat['class'] }}">
                                {{ $predikat['huruf'] }}
                            </span>
                        </td>
                        <td class="center">{{ $predikat['label'] }}</td>
                    </tr>
                @endforeach

                {{-- Total / Summary Row --}}
                @php $overallPredikat = getPredikat($overall_average); @endphp
                <tr class="total-row">
                    <td colspan="3" style="text-align: right; font-size: 10px; letter-spacing: 0.5px;">
                        RATA-RATA KESELURUHAN
                    </td>
                    <td class="center">
                        @if ($overall_average !== null)
                            <span class="grade-final">{{ number_format($overall_average, 1) }}</span>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td class="center">
                        <span class="predikat-badge">{{ $overallPredikat['huruf'] }}</span>
                    </td>
                    <td class="center" style="font-size: 10px;">{{ $overallPredikat['label'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- ════════════════════════════════════════════════════
         GRADING LEGEND
    ════════════════════════════════════════════════════ --}}
    <div class="legend">
        <div class="legend-title">&#9632; Keterangan Sistem Penilaian PintarKan</div>
        <div class="legend-grid">
            <div class="legend-item"><strong>A</strong> &mdash; Sangat Baik &nbsp;(&ge; 85%)</div>
            <div class="legend-item"><strong>B</strong> &mdash; Baik &nbsp;(70% &ndash; 84%)</div>
            <div class="legend-item"><strong>C</strong> &mdash; Cukup &nbsp;(55% &ndash; 69%)</div>
            <div class="legend-item"><strong>D</strong> &mdash; Kurang &nbsp;(40% &ndash; 54%)</div>
            <div class="legend-item"><strong>E</strong> &mdash; Gagal &nbsp;(&lt; 40%)</div>
        </div>
        <div style="font-size: 9px; color: #94a3b8; margin-top: 6px;">
            * Nilai akhir dihitung berdasarkan persentase rata-rata skor tugas yang telah dinilai terhadap skor maksimum
            pada setiap mata kuliah yang diikuti mahasiswa di platform PintarKan.
        </div>
    </div>

    {{-- ════════════════════════════════════════════════════
         SIGNATURE FOOTER
    ════════════════════════════════════════════════════ --}}
    <div class="doc-footer">
        <div class="footer-left-cell">
            <div class="footer-note">
                <strong>PintarKan Learning Management System</strong><br>
                Dokumen ini diterbitkan secara otomatis oleh sistem.<br>
                Sah tanpa tanda tangan basah jika diterbitkan dari portal resmi PintarKan.
            </div>
        </div>
        <div class="footer-right-cell">
            <div class="sign-label">Mengetahui, Dosen Pembina</div>
            <div class="sign-gap"></div>
            <div class="sign-name">{{ $lecturer->name ?? '-' }}</div>
            @if (!empty($lecturer->nidn))
                <div class="sign-nidn">NIDN. {{ $lecturer->nidn }}</div>
            @endif
            <div class="sign-title">Dosen &mdash; PintarKan LMS</div>
        </div>
    </div>

</body>

</html>
