<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Community</th>
            <th>Maps</th>
            <th>Race</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($participants as $participant)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $participant->peserta }}</td>
                <td>{{ $participant->community }}</td>
                <td>{{ $participant->maps }}</td>
                <td>{{ $participant->race }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
