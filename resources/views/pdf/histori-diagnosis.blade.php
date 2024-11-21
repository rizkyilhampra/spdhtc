@extends('layouts.pdf-layout')
@section('title', 'Data Histori Diagnosis')
@section('content')
    <table>
        <thead>
            <tr>
                <th>
                    No
                </th>
                <th>Nama Pengguna</th>
                @auth
                    <th>Email Pengguna</th>
                @endauth
                <th>Nama Penyakit</th>
                <th>Tanggal Dibuat/Diubah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historiDiagnosis as $key)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>{{$key['user']['name']}}</td>
                    @auth
                        <td>{{ $key['user']['email'] }}</td>
                    @endauth
                    <td>{{ $key['penyakit']['name'] }}</td>
                    <td>{{ $key['updated_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
