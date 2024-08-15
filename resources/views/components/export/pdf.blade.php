{{-- === style dan script internal === --}}
<script src="https://cdn.tailwindcss.com"></script>
{{-- === akhir style dan script internal === --}}
<div id="team" class="section relative pt-20 pb-8 md:pt-16">
    <div class="container mx-auto px-1 lg:px-4">
        <header class="text-start mx-auto mb-12">
            <h2 class="text-7xl text-center bebas-neue-regular mb-2 font-bold text-gray-800 "
                style="text-transform: uppercase; text-align:center">
                Table Participants Perlombaan
            </h2>
            <div class="text-center" style="text-align:center"">
                {{ $name }}
            </div>
            <br>
        </header>
        {{-- === data peserta perlombaan === --}}
        <table border="0" cellspacing="0" cellpadding="8"
            style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; color: #333; background-color: #f9f9f9;">
            <thead>
                <tr style="background-color: #4C77AF; color: white; text-align: left;">
                    <th style="padding: 12px; border-bottom: 2px solid #ddd;">No</th>
                    <th style="padding: 12px; border-bottom: 2px solid #ddd;">Sekolah</th>
                    <th style="padding: 12px; border-bottom: 2px solid #ddd;">Alamat</th>
                    <th style="padding: 12px; border-bottom: 2px solid #ddd;">Peserta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participants as $index => $participant)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 12px;">{{ $index + 1 }}</td>
                        <td style="padding: 12px;">{{ $participant->community }}</td>
                        <td style="padding: 12px;">{{ $participant->maps }}</td>
                        <td style="padding: 12px;">{{ $participant->peserta }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- === akhir data peserta perlombaan === --}}

    </div>
</div>
