<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengajuan SPB') }}
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
                                <th class="border border-gray-800 px-2">No SPB</th>
                                <th class="border border-gray-800 px-2">Tanggal Aju</th>
                                <th class="border border-gray-800 px-2">Disetujui</th>
                                <th class="border border-gray-800 px-2">Realisasi</th>
                                <th class="border border-gray-800 px-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                             @if($daftaraju->isEmpty())
                            <tr>
                                <td class="border border-gray-800 px-2 text-center" colspan="4">Belum ada data</td>
                            </tr>
                            @else
                                <?php $i=1?>
                                @foreach($daftaraju as $aju)
                                <tr>
                                    <td class="border border-gray-800 px-2 py-1"><?=$i?></td>
                                    <td class="border border-gray-800 px-2">{{ $aju->nomor_spb }}</td>
                                    <td class="border border-gray-800 px-2">{{ date('d F Y', $aju->epoch_spb) }}</td>
                                    <td class="border border-gray-800 px-2">
                                        <?= ( !$aju->isApproved ? '<div class="text-white bg-gray-900 rounded p-1 text-xs text-center font-semibold uppercase">Belum</div>' :  '<div class="text-white bg-green-500 rounded p-1 text-xs text-center font-semibold uppercase">Sudah</div>' ) ?>
                                    </td>
                                    <td class="border border-gray-800 px-2">

                                        <div class="text-white bg-gray-900 rounded p-1 text-xs text-center font-semibold uppercase">Belum</div>
                                    </td>
                                    <td class="border border-gray-800 px-2">
                                        <a href="{{ route('daftar.ajus.spb', $aju->nomor_spb) }}">detail</a> |
                                        <a href="{{ route('daftar.ajus.realisasi', $aju->nomor_spb) }}">realisasi</a>
                                    </td>
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