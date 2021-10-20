<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kartu Stok') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto border-collapse border border-gray-800 w-full">
                        <thead class="bg-gray-400">
                            <tr>
                                <th class="border border-gray-800 px-2">No</th>
                                <th class="border border-gray-800 px-2">Nomor Kartu</th>
                                <th class="border border-gray-800 px-2">Nama Barang</th>
                                <th class="border border-gray-800 px-2">Satuan</th>
                                <th class="border border-gray-800 px-2">Stok Awal</th>
                                <th class="border border-gray-800 px-2">Pengeluaran</th>
                                <th class="border border-gray-800 px-2">Stok Akhir</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                             @if($daftarstok->isEmpty())
                            <tr>
                                <td class="border border-gray-800 px-2 text-center" colspan="7">Belum ada data</td>
                            </tr>
                            @else
                                <?php $i=1?>
                                @foreach($daftarstok as $stok)
                                <tr>
                                    <td class="border border-gray-800 px-2 py-1"><?=$i?></td>
                                    <td class="border border-gray-800 px-2">{{ $stok->nomor_kartu }}</td>
                                    <td class="border border-gray-800 px-2">{{ $stok->nama_barang }}</td>
                                    <td class="border border-gray-800 px-2">{{ $stok->satuan }}</td>
                                    <td class="border border-gray-800 px-2" align="right">{{($stok->masuk == null ? 0: $stok->masuk)}}</td>
                                    <td class="border border-gray-800 px-2" align="right">{{($stok->keluar == null ? 0: $stok->keluar)}}</td>
                                    <td class="border border-gray-800 px-2" align="right">{{($stok->sisa == null ? 0:$stok->sisa)}}</td>
                                </tr>
                                <?php $i++?>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>