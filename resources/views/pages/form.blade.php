<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Isian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row gap-4">
                <div class=" text-center p-6 bg-white border-b border-gray-200 hover:bg-green-400 hover:text-white hover:font-bold rounded">
                    <div class="">
                        <a href="{{ route('form.spb') }}">Surat Pemesanan Barang</a>
                    </div>
                </div>
                <div class="text-center p-6 bg-white border-b border-gray-200 hover:bg-purple-400 hover:text-white hover:font-bold rounded">
                    <div>
                        <a href="{{ route('form.sbbk') }}">Surat Bukti Barang Keluar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>