<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Aju SPB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-5">
                        <div class="capitalize text-sm font-bold">Nomor SPB: {{ $detailaju[0]->nomor_spb }}</div>
                        <div class="capitalize text-sm font-bold">Tanggal: {{ date('d F Y', $detailaju[0]->epoch_entry) }}</div>
                        <div class="capitalize text-sm font-bold">Pemesan : {{ $detailaju[0]->poksi }}</div>
                    </div>
                    <table class="table-auto border-collapse border border-gray-800 w-full">
                        <thead class="bg-gray-400">
                            <tr>
                                <th class="border border-gray-800 px-2">No</th>
                                <th class="border border-gray-800 px-2">Nomor Kartu</th>
                                <th class="border border-gray-800 px-2">Nama Barang</th>
                                <th class="border border-gray-800 px-2">Jumlah Pesanan</th>
                                <th class="border border-gray-800 px-2">Satuan</th>
                                <th class="border border-gray-800 px-2">Peruntukan</th>
                            </tr>
                        </thead>
                        <tbody>                                                   
                             @if($detailaju->isEmpty())
                            <tr>
                                <td class="border border-gray-800 px-2 text-center" colspan="4">Belum ada data</td>
                            </tr>
                            @else
                                <?php $i=1?>
                                @foreach($detailaju as $aju)
                                <tr>
                                    <td class="border border-gray-800 px-2"><?=$i?></td>
                                    <td class="border border-gray-800 px-2">{{ $aju->nomor_kartu }}</td>
                                    <td class="border border-gray-800 px-2">{{ $aju->nama_barang }}</td>
                                    <td class="border border-gray-800 px-2" align="right">{{ $aju->jumlah_pesanan }}</td>
                                    <td class="border border-gray-800 px-2">
                                        {{ $aju->satuan }}
                                    </td>
                                    <td class="border border-gray-800 px-2">
                                        {{ $aju->peruntukan }}
                                    </td>
                                </tr>
                                <?php $i++?>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="flex items-center justify-end mt-4">
                        @if(!$ajuApproval->isApproved)

                            <form method="POST" action="{{ route('daftar.ajus.approval') }}">
                                @csrf
                                <input type="hidden" name="nomor_spb" value="{{ $detailaju[0]->nomor_spb }}">
                                <input type="hidden" name="setuju" value="true">
                                <x-button class="ml-3 bg-green-700">
                                    {{ __('Setuju') }}
                                </x-button>
                            </form>
                       

                            <form method="POST" action="{{ route('daftar.ajus.approval') }}">
                                @csrf
                                <input type="hidden" name="nomor_spb" value="{{ $detailaju[0]->nomor_spb }}">
                                <input type="hidden" name="setuju" value="false">
                                <x-button class="ml-3">
                                    {{ __('Tidak setuju') }}
                                </x-button>
                            </form>
                        @else
                                <x-button class="ml-3 bg-green-700">
                                    {{ __('Print SPB') }}
                                </x-button>

                                @if($ajuApproval->isSbbk)
                                <x-button class="ml-3 bg-blue-700">
                                    {{ __('Print SBBK') }}
                                </x-button>
                                @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>