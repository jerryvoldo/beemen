<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Realisasi Aju SPB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6">
                        <div class="capitalize font-bold">Nomor SPB: {{$dataspb[0]->nomor_spb}}</div>
                        <hr>
                    </div>
                    <form method="POST" action="{{ route('daftar.ajus.realisasi.store') }}">
                        @csrf
                       @foreach($dataspb as $item)
                       <div class="mb-6 flex md:flex-row gap-4">
                            <div class="w-full flex flex-col justify-center px-1">
                                <label class="block font-semibold text-lg text-gray-700">{{ $item->nama_barang }}</label>
                                <div class="text-sm">
                                    Pesan: {{ $item->jumlah_pesanan }}  {{ $item->satuan }}
                                </div>
                            </div>
                            <div class="w-full">
                                <label class="block font-semibold text-md mb-1 text-gray-700">Realisasi</label>
                                <input id="jumlah_realisasi" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block w-full" type="number" name="jumlah_pesanan[]"   required autofocus />
                                <input type="hidden" name="nomor_kartu[]" value="{{ $item->nomor_kartu }}">
                            </div>
                        </div>
                       @endforeach
                       <input type="hidden" name="nomor_spb" value="{{ $dataspb[0]->nomor_spb }}">
                       <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Simpan') }}
                            </x-button>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>