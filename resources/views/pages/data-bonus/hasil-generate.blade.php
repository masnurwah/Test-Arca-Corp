<div class="row mt-3">
    <div class="col-md-12">
        <h6 class="p-3 text-center">
            Hasil Generate
        </h6>
    </div>
    <div class="col-md-12">
        <form method="POST" action="{{ route('data-bonus.store') }}">
            @csrf
            <input type="hidden" name="jumlah_pembayaran" value="{{ $jumlah_pembayaran }}">
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

                        <input type="hidden" name="pembayaran[{{$key}}][id_buruh]" value="{{$data['id_buruh']}}">
                        <input type="hidden" name="pembayaran[{{$key}}][presentase_bonus]"
                            value="{{$data['presentase_bonus']}}">
                        <input type="hidden" name="pembayaran[{{$key}}][total_bonus]"
                            value="{{$data['total_bonus']}}">

                        <td> {{ $data['nama_buruh'] }}</td>
                        <td> Rp. {{ $data['total_bonus'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row ">
                <div class="col text-center">

                    <button type="submit" class="btn btn-danger">Simpan Hasil</button>
                </div>
            </div>
        </form>



    </div>
</div>