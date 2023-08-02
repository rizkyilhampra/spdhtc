@extends('layouts.pdf-layout')
@section('title', 'Data Gejala')
@section('content')
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>
                    No
                </th>
                <th>Nama</th>
                <th>Tanggal Dibuat/Diubah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gejala as $p)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>{{ $p['name'] }}</td>
                    <td>{{ $p['updated_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
