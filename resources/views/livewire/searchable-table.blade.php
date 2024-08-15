<div class="table-container">
    <input wire:model="search" type="search" placeholder="Search posts by title..." class="search-input">
    <table class="custom-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Sekolah</th>
                <th>Maps</th>
                <th>Peserta</th>
            </tr>
        </thead>
        <tbody>
            @php
                $previousCommunity = null;
            @endphp
            @foreach ($data as $item)
                <tr class="body">
                    <td>
                        @if ($item->community != $previousCommunity)
                            {{ $loop->iteration }}
                        @endif
                    </td>
                    <td>
                        @if ($item->community != $previousCommunity)
                            {{ $item->community }}
                        @endif
                    </td>
                    <td>
                        @if ($item->community != $previousCommunity)
                            {{ $item->maps }}
                        @endif
                    </td>
                    <td>{{ $item->peserta }}</td>
                </tr>
                @php
                    $previousCommunity = $item->community;
                @endphp
            @endforeach
        </tbody>
    </table>

    <div class="pagination-links">
        {{ $data->links() }}
    </div>
</div>

<style>
    /* Container untuk tabel agar responsif */
    .table-container {
        overflow-x: auto;
        margin-bottom: 20px;
    }

    /* Input pencarian */
    .search-input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 15px;
        width: 100%;
        max-width: 400px;
        box-sizing: border-box;
    }

    /* Tabel custom */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        overflow: hidden;
    }

    /* Header tabel */
    .custom-table thead {
        background-color: #3498db;
        color: white;
    }

    .custom-table th,
    .custom-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    /* Hover efek untuk baris */
    .custom-table .body:hover {
        background-color: #f1f1f1;
    }

    /* Responsif untuk perangkat kecil */
    @media screen and (max-width: 600px) {

        .custom-table th,
        .custom-table td {
            padding: 8px 10px;
        }
    }

    /* Style untuk pagination links */
    .pagination-links {
        margin-top: 20px;
        text-align: center;
    }

    /* Tambahkan margin dan padding untuk links pagination */
    .pagination-links .pagination {
        display: inline-flex;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination-links .pagination li {
        margin: 0 5px;
    }

    .pagination-links .pagination a,
    .pagination-links .pagination span {
        display: block;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        color: #333;
        text-decoration: none;
    }

    .pagination-links .pagination a:hover {
        background-color: #3498db;
        color: white;
    }

    .pagination-links .pagination .active span {
        background-color: #3498db;
        color: white;
        border-color: #3498db;
    }
</style>
