<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h5> Informasi Pribadi</h5>
        <table class>
            <tr>
                <td><strong>Nama</strong></td>
                <td>{{ $data['name'] }}</td>
            </tr>
            <tr>
                <td><strong>Umur</strong></td>
                <td>{{ $data['my_age'] }} tahun</td>
            </tr>
            <tr>
                <td><strong>Semester</strong></td>
                <td>{{ $data['current_semester'] }}</span>
                </td>
            </tr>
            <tr>
                <td><strong>Cita-cita</strong></td>
                <td> {{ $data['future_goal'] }}</td>
            </tr>
        </table>
    <h5> Informasi Akademik</h5>
        <table class>
            <tr>
                <td><strong>Tanggal Wisuda</strong></td>
                <td>{{ $data['tgl_harus_wisuda'] }}</td>
            </tr>
            <tr>
                <td><strong>Jumlah Hari Lagi</strong></td>
                <td>
                @if($data['time_to_study_left'] > 0)
                    {{ $data['time_to_study_left'] }} hari</span>
                @else
                    {{ abs($data['time_to_study_left']) }} hari terlambat</span>
                @endif
                </td>
            </tr>
        </table>
        <h5>Hobi:</h5>
            @foreach($data['hobbies'] as $hobby)
                {{ $hobby }}</span>
            @endforeach
        </div>
            <h5>Pesan Akademik</h5>
                {{ $data['semester_message'] }}</p>
        </div>
            <h5>Timeline Studi</h5>
            @php
                $progress = min(($data['current_semester'] / 8) * 100, 100);
            @endphp
        <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;"
            aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                Semester {{ $data['current_semester'] }} dari 8
        </div>
        </div>
            <small class="text-muted">Progress menuju wisuda: {{ number_format($progress, 1) }}%</small>
        </div>
            <br>
        </div>
            Data diperbarui pada: {{ date('d-m-Y H:i:s') }}
        </div>
</body>
</html>
