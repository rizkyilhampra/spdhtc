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
                <th>No Gejala</th>
                <th>Gejala</th>
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
                    <td>{{ $rule['no_gejala'] }}</td>
                    <td>{{ $rule['gejala']['name'] }}</td>
                    <td>{{ $rule['updated_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
