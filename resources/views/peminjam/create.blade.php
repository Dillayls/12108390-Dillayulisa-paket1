@extends('peminjam.dashboard-page')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @foreach ($buku as $bk)
                {{ __('Borrow Book') }} "{{$bk->judul}}"
            @endforeach
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form method="POST" action="{{ route('pinjamBuku', ['id' => $bk->id]) }}">
                @csrf
                <div class="mb-4">
                    <label for="tanggal_peminjaman" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Pinjam:</label>
                    <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('tanggal_pinjam') }}">
                    @error('tanggal_peminjaman')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
