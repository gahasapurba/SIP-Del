<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Invoice SIP Del - {{ $item->title }}</title>
		<link rel="icon" type="image/x-icon" href="/images/favicon.ico">
		<style>
			@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
			
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 5px solid #0079c1;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.70);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Poppins', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.top table td.title span.biru {
				color: #0079c1;
			}
			
			.invoice-box table tr.top table td.title span.ungu {
				color: #46146b;
			}
			
			.invoice-box table tr.top table td.subtitle {
				font-size: 13px;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1.5px solid #46146b;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
                font-size: 14px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1.5px solid #46146b;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #46146b;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: 'Poppins', Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									{{-- <img alt="SIP Del" style="width: 100%; max-width: 300px" src="/images/logo2.png" /> --}}
									<h1><span class="ungu">SIP</span> <span class="biru">Del</span></h1>
									<p style="font-size: 22px; margin-top: -65px;"><b>Sistem Informasi Purchasing IT Del</b></p>
								</td>

								<td class="subtitle">
									<b>Dibuat Pada</b> :<br>{{ $item->created_at->isoFormat('dddd, D MMMM Y, HH:mm:ss') }}<br />
									<b>Jatuh Tempo</b> :<br>{{ $item->created_at->addDays(7)->isoFormat('dddd, D MMMM Y, HH:mm:ss') }}<br />
									<b>Purchasing Code</b> :<br>SIPDEL-{{ strtoupper($hash->encodeHex($item->id)) }}-{{ $item->created_at->isoFormat('DMYY') }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									<b>Institut Teknologi Del</b>.<br />
									Sitoluama, Kec. Laguboti<br />
									Kab. Toba, Sumatera Utara, Indonesia<br />
                                    22381
								</td>

								<td>
									Perusahaan :<br>
									<b>{{ $item->company_name }}</b>.
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td><b>Deskripsi Pembelian</b></td>

					<td></td>
				</tr>

				<tr class="details">
					<td>{!! $item->description !!}</td>

					<td></td>
				</tr>

				<tr class="heading">
					<td><b>Judul Pembelian :</b></td>

					<td>{{ $item->title }}</td>
				</tr>

				<tr class="item">
					<td><b>Kategori :</b></td>

					<td>{{ $item->category->name }}</td>
				</tr>

				<tr class="item">
					<td><b>Status Pembelian :</b></td>

					<td style="
                        @if($item->purchasing_status == 'belum')
                            color: #dc3546;
                        @elseif($item->purchasing_status == 'sudah')
                            color: #27a844;
                        @endif
                    ">
                        @if($item->purchasing_status == 'belum')
                            <b>Belum Dibayar</b>
                        @elseif($item->purchasing_status == 'sudah')
                            <b>Sudah Dibayar</b>
                        @endif
                    </td>
				</tr>

				<tr class="details">
					<td></td>
					<td></td>
				</tr>
				<tr class="details">
					<td></td>
					<td></td>
				</tr>

				<tr class="heading">
					<td><b>Item Yang Dibeli :</b></td>

					<td><b>Harga</b></td>
				</tr>

				@php
					$totalPrice = 0
				@endphp

				@foreach ($item->items as $itemPembelian)

				@php
					$totalPrice += $itemPembelian->price_total_item
				@endphp

				<tr class="item">
					<td>{{ $itemPembelian->name }} ({{ $itemPembelian->quantity }} * Rp{{ number_format($itemPembelian->price_per_item,2,",",".") }})</td>

					<td>Rp{{ number_format($itemPembelian->price_total_item,2,",",".") }}</td>
				</tr>

				@endforeach

				<tr class="total">
					<td></td>

					<td><h2>Biaya Total Pembelian : Rp{{ number_format($totalPrice ?? '0',2,",",".") }}</h2></td>
				</tr>
			</table>
		</div>
	</body>
</html>