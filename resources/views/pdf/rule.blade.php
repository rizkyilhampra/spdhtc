@extends('layouts.pdf-layout')
@section('title', 'Data Rule')
@section('content')
    <table>
        <thead>
            <tr>
                <th>
                    No
                </th>
                <th>Penyakit</th>
                <th>Gejala</th>
                <th>Gejala Pertama pada Rule Selanjutnya</th>
                <th>Tanggal Dibuat/Diubah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rules as $rule)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>{{ $rule['penyakit']['name'] }}</td>
                    <td>{{ $rule['gejala']['name'] }}</td>
                    <td>{{ $rule['nextGejala'] }}</td>
                    <td>{{ $rule['updated_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
