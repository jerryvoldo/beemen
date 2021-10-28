<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Cetak SPB</title>

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
	<h2>SURAT PERMINTAAN BARANG (SPB)</h2>
</center>
<p>
	<table>
		<tr>
			<td>Nomor</td>
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
				<th rowspan="2">DISETUJUI</th>
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
				<th>7</th>
			</tr>
		</thead>
		<tbody>
			<?php $i=1?>
			@foreach($detailaju as $aju)
			<tr>
				<td align="center"><?=$i?></td>
				<td align="center">{{ $aju->nomor_kartu }}</td>
				<td>{{ $aju->nama_barang }}</td>
				<td align="right">{{ $aju->jumlah_pesanan }}</td>
				<td>{{ $aju->satuan }}</td>
				<td>{{ $aju->poksi }}</td>
				<td>{{ ($ajuApproval->isApproved ? 'DISETUJUI' : 'TIDAK DISETUJUI') }}</td>
			</tr>
			<?php $i++?>
			@endforeach
		</tbody>
	</table>
</p>
<p>
	<table>
		<tr>
			<td></td>
			<td>
				<div>Tanggal: <?=date('d F Y', time())?></div>
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
</center>
</body>
</html>