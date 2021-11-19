
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Cetak SBBK</title>

	<style type="text/css">
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th {
			  height: 20px;
			  padding: 3px;
			}

		td {
			 padding: 1px;
		}
	</style>
</head>
<body>
<center>
	<h2>SURAT BUKTI BARANG KELUAR (SBBK)</h2>
	<h4>Nomor SBBK : {{ $detailaju[0]->nomor_sbbk }}</h4>
</center>
<p>
	<table>
		<tr>
			<td>Nomor SPB</td>
			<td>:</td>
			<td>{{ $detailaju[0]->nomor_spb }}</td>
		</tr>
		<tr>
			<td>Unit</td>
			<td>:</td>
			<td>Direktorat Pengawasan Peredaran Pangan Olahan</td>
		</tr>
	</table>
</p>
<p>
	<table border="1">
		<thead>
			<tr>
				<th rowspan="2">NO</th>
				<th rowspan="2">NO URUT KARTU</th>
				<th rowspan="2" style="width: 200px ;">NAMA BARANG</th>
				<th colspan="2">PERMINTAAN</th>
				<th rowspan="2">PENGAJU</th>
			</tr>
			<tr>
				<th>QTY</th>
				<th>Satuan</th>
			</tr>
			<tr>
				<th>1</th>
				<th>2</th>
				<th>3</th>
				<th>4</th>
				<th>5</th>
				<th>6</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1?>
			@foreach($detailaju as $aju)
			@if($aju->jumlah_keluar > 0)
			<tr>
				<td align="center"><?=$i?></td>
				<td align="center">{{ $aju->nomor_kartu }}</td>
				<td>{{ $aju->nama_barang }}</td>
				<td align="right">{{ $aju->jumlah_keluar }}</td>
				<td>{{ $aju->satuan }}</td>
				<td>{{ $aju->poksi }}</td>
			</tr>
			<?php $i++?>
			@endif
			@endforeach
		</tbody>
	</table>
</p>
<p>
	<table>
		<tr>
			<td></td>
			<td>
				<div>Tanggal: {{ date('d F Y', $ajuApproval->epoch_approved) }}</div>
					<p>
						<div>Mengetahui/Menyetujui</div>
						<div>Subkoordinator Tata Operasional</div>
						<br><br><br><br>
						<div>Aryana Sayekti, S.T.</div>
						<div>NIP. 198306302007122001</div>
					</p>
			</td>
		</tr>
	</table>
	</p>

<p >
	<table border="1" style="position: absolute;">	
		<thead>
			<tr>
				<th colspan="2">PENERIMA</th>
				<th colspan="2">PETUGAS PENGELOLA PERSEDIAAN</th>
			</tr>
			<tr>
				<th>Nama</th>
				<th>TTD/tanggal</th>
				<th>Nama</th>
				<th>TTD/tanggal</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><br><br><br><br></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</p>
</body>
</html>