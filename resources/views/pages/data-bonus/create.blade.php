@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            <div class="card">
                <div class="card-header">Add Data Bonus</div>

                <div class="card-body">
                    <form method="POST" id="BonusForm">
                        @csrf

                        <div class="form-group row">
                            <label for="JumlahPembayaran" class="col-md-4 col-form-label text-md-right">Jumlah
                                Pembayaran (Rp)</label>

                            <div class="col-md-6">
                                <input id="JumlahPembayaran" type="number" class="form-control" name="jumlah_pembayaran"
                                    value="{{ old('name') }}" required>
                            </div>
                        </div>

                        @for($i=1; $i <= 3; $i++) <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Buruh {{ $i }}</label>
                            <div class="col-md-6">
                                <div class="form-row">
                                    <div class="col">
                                        <select name="id_buruh[{{ $i }}]" class="form-control" required>
                                            <option value="">-- Select Buruh {{ $i }} --</option>
                                            @foreach($models_buruh as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="presentase_bonus[{{ $i }}]"
                                                placeholder="Persentase" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                </div>

                @endfor


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success" id="generate">Generate</button>
                    </div>
                </div>

                </form>

                <div id="BonusHasilForm"></div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#BonusForm").submit(function(e) {

        e.preventDefault();

        // let JumlahPembayaran = $("#JumlahPembayaran")
        // if (JumlahPembayaran.val() == "") {
        //     alert("Jumlah Pembayaran Required");
        //     JumlahPembayaran.focus()
        //     return false;
        // }

        var $form = $(this);

        var serializedData = $form.serialize();


        $.ajax({
            url: '{{ route("data-bonus.store") }}',
            type: "post",
            data: serializedData,
            success: function(response) {

                if (response.success == false) {
                    $("#BonusHasilForm").html("");
                    alert(response.message);
                    return false;
                }

                if (response.success == true) {

                    $("#BonusHasilForm").html(response.view);

                    console.log(response);
                    // return false;
                }

                console.log(response)

                // You will get response from your PHP page (what you echo or print)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });

        // {{ route('data-bonus.store') }}
    })
})
</script>
@endsection