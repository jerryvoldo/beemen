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
                                <th class="border border-gray-800 px-2">Masuk</th>
                                <th class="border border-gray-800 px-2">Keluar</th>
                                <th class="border border-gray-800 px-2">Sisa Aju</th>
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
                                    <td class="border border-gray-800 px-2" align="right">{{ (null == $aju->masuk ? 0 : $aju->masuk) }}</td>
                                    <td class="border border-gray-800 px-2" align="right">{{ (null == $aju->keluar ? 0 : $aju->keluar) }}</td>
                                    <td class="border border-gray-800 px-2" align="right">{{ (null == $aju->sisa ? 0 : $aju->sisa) }}</td>
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
                            @can('superadmin')
                            <form method="POST" action="{{ route('daftar.ajus.approval') }}">
                                @csrf
                                <input type="hidden" name="nomor_spb" value="{{ $detailaju[0]->nomor_spb }}">
                                <input type="hidden" name="setuju" value="true">
                                <x-button class="ml-3 bg-green-700">
                                    {{ __('Setuju') }}
                                </x-button>
                            </form>
                            @endcan
                        @else
                            <form method="POST" action="{{ route('daftar.ajus.spb.print') }}">
                                @csrf
                                <input type="hidden" name="nomor_spb" value="{{ $detailaju[0]->nomor_spb }}">
                                <x-button class="ml-3 bg-green-700">
                                    {{ __('Print SPB') }}
                                </x-button>
                            </form>

                            <form method="GET" action="{{ route('daftar.ajus.sbbk.view', $detailaju[0]->nomor_spb) }}">
                                <x-button class="ml-3 bg-gray-800">
                                    {{ __('Buat SBBK') }}
                                </x-button>
                            </form>
                        @endif
                    </div>

                    <div class="mt-4 mb-2">
                        <p class="capitalize text-sm font-bold">Daftar SBBK</p>
                    </div>
                    <table class="table-auto border-collapse border border-gray-800 w-full">
                        <thead class="bg-gray-400">
                            <tr>
                                <th class="border border-gray-800 px-2">No</th>
                                <th class="border border-gray-800 px-2">Nomor SBBK</th>
                                <th class="border border-gray-800 px-2">Tanggal</th>
                                <th class="border border-gray-800 px-2">Penerima</th>
                                <th class="border border-gray-800 px-2"></th>
                            </tr>
                        </thead>
                        <tbody>                                                   
                             @if($detailaju->isEmpty())
                            <tr>
                                <td class="border border-gray-800 px-2 text-center" colspan="5">Belum ada data</td>
                            </tr>
                            @else
                                <?php $i=1?>
                                @foreach($daftarsbbk as $sbbk)
                                <tr>
                                    <td class="border border-gray-800 px-2"><?=$i?></td>
                                    <td class="border border-gray-800 px-2">{{ $sbbk->nomor_sbbk }}</td>
                                    <td class="border border-gray-800 px-2">{{ date('d F Y', $sbbk->epoch_sbbk) }}</td>
                                    <td class="border border-gray-800 px-2">{{ $sbbk->nama }}</td>
                                    <td class="border border-gray-800 px-2 py-1" align="center">
                                        @if($ajuApproval->isSbbk)
                                            <form method="POST" action="{{ route('daftar.ajus.sbbk.print') }}">
                                                @csrf
                                                <input type="hidden" name="nomor_spb" value="{{ $detailaju[0]->nomor_spb }}">
                                                <x-button class="ml-3 bg-blue-700">
                                                    {{ __('Print SBBK') }}
                                                </x-button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                <?php $i++?>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <p class="mt-4 text-center">
                        {{ $detailaju->onEachSide(5)->links() }}
                    </p>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>