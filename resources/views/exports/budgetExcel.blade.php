<table style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Type</th>
            <th>Date</th>
            <th>Harga (satuan)</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($budgets as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                <td>{{ 'Rp' . number_format($item->price_out, 0, ',', '.') }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ 'Rp' . number_format($item->price_out * $item->quantity, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6">Jumlah</th>
            <th colspan="1">{{ 'Rp' . number_format($sum_budget, 0, ',', '.') }}</th>
        </tr>
    </tfoot>
    <tfoot>
        <tr>
            <th colspan="6">Saldo Awal</th>
            <th colspan="1">{{ 'Rp' . number_format($sum_budget_in, 0, ',', '.') }}</th>
        </tr>
    </tfoot>
    <tfoot>
        <tr>
            <th colspan="6">Saldo Akhir</th>
            <th colspan="1">{{ 'Rp' . number_format($saldo, 0, ',', '.') }}</th>
        </tr>
    </tfoot>
</table>
