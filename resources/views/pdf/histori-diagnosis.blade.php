@extends('layouts.pdf')
@section('title', 'Data Histori Diagnosis')
@section('content')
    <table>
        <thead>
            <tr>
                <th>
                    No
                </th>
                <th>Nama Pengguna</th>
                <th>Email Pengguna</th>
                <th>Nama Penyakit</th>
                <th>Tanggal Dibuat/Diubah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historiDiagnosis as $key)
                <tr>
                    <td>
                        {{ $key['id'] }}
                    </td>
                    <td>{{ $key['user']['name'] }}</td>
                    <td>{{ $key['user']['email'] }}</td>
                    <td>{{ $key['penyakit']['name'] }}</td>
                    <td>{{ $key['updated_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
