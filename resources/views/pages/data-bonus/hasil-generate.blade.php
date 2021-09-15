<div class="row mt-3">
    <div class="col-md-12">
        <h6 class="p-3 text-center">
            Hasil Generate
        </h6>
    </div>
    <div class="col-md-12">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama Buruh</th>
                    <th scope="col">Total Bonus</th>

                </tr>
            </thead>
            <tbody>
                @foreach($data_buruh as $key => $data)
                <tr>

                    <td> {{ $data['nama_buruh'] }}</td>
                    <td> Rp. {{ $data['total_bonus'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>