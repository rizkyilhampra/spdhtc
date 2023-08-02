@extends('layouts.pdf-layout')
@section('title', 'Data Penyakit')
@section('content')
    <table>
        <thead>
            <tr>
                <th>
                    No
                </th>
                <th>Nama</th>
                <th>Penyebab</th>
                <th>Solusi</th>
                <th>Tanggal Dibuat/Diubah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penyakit as $p)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>{{ $p['name'] }}</td>
                    <td>{{ $p['reason'] }}</td>
                    <td>{{ $p['solution'] }}</td>
                    <td>{{ $p['updated_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
