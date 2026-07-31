@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header">

        <h3 style = "float: inline-start;">Create Production Bundle</h3>
        <a href="{{ route('bundles.index') }}" style = "float: inline-end;" class="btn btn-secondary">
            Back
        </a>

    </div>

    <div class="card-body">

        <form id="bundleForm">

            @csrf
            <div class="row">

                <div class="col-md-4 mb-3">

                    <label>Bundle Number</label>

                    <input type="text"
                        name="bundle_no"
                        class="form-control">
                    <small class="text-danger error-text bundle_no_error"></small>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Buyer</label>

                    <select name="buyer_id"
                            id="buyer_id"
                            class="form-select">

                        <option value="">Select Buyer</option>

                        @foreach($buyers as $buyer)

                            <option value="{{ $buyer->id }}">
                                {{ $buyer->buyer_name }}
                            </option>

                        @endforeach

                    </select>
                    <small class="text-danger error-text buyer_id_error"></small>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Style</label>

                    <select name="style_id"
                            id="style_id"
                            class="form-select">

                        <option value="">Select Style</option>

                        @foreach($styles as $style)

                            <option value="{{ $style->id }}">
                                {{ $style->style_no }}
                            </option>

                        @endforeach

                    </select>
                    <small class="text-danger error-text style_id_error"></small>

                </div>

            </div>

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label>Color</label>

                    <input type="text"
                        name="color"
                        class="form-control">
                    <small class="text-danger error-text color_error"></small>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Size</label>

                    <input type="text"
                        name="size"
                        class="form-control">
                    <small class="text-danger error-text size_error"></small>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Sewing Line</label>

                    <select name="line_id"
                            class="form-select">

                        <option value="">Select Line</option>

                        @foreach($lines as $line)

                            <option value="{{ $line->id }}">
                                {{ $line->line_name }}
                            </option>

                        @endforeach

                    </select>
                    <small class="text-danger error-text line_id_error"></small>

                </div>

            </div>

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label>Quantity</label>

                    <input type="number"
                        id="quantity"
                        name="quantity"
                        class="form-control">
                    <small class="text-danger error-text quantity_error"></small>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Completed</label>

                    <input type="number"
                        id="completed_qty"
                        name="completed_qty"
                        value="0"
                        class="form-control">
                    <small class="text-danger error-text completed_qty_error"></small>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Rejected</label>

                    <input type="number"
                        id="rejected_qty"
                        name="rejected_qty"
                        value="0"
                        class="form-control">
                    <small class="text-danger error-text rejected_qty_error"></small>

                </div>

            </div>

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label>Balance</label>

                    <input type="text"
                        id="balance"
                        class="form-control"
                        readonly>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Efficiency %</label>

                    <input type="text"
                        id="efficiency"
                        class="form-control"
                        readonly>

                </div>

                <div class="col-md-4 mb-3">

                    <label>Rejection %</label>

                    <input type="text"
                        id="rejection"
                        class="form-control"
                        readonly>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Operator Name</label>

                    <input type="text"
                        name="operator_name"
                        class="form-control">
                    <small class="text-danger error-text operator_name_error"></small>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Production Date</label>

                    <input type="date"
                        name="production_date"
                        class="form-control">
                    <small class="text-danger error-text production_date_error"></small>

                </div>

            </div>

            <div class="mb-3">

                <label>Remarks</label>

                <textarea name="remarks"
                        class="form-control"></textarea>

            </div>

            <button type="submit" id="saveBtn" class="btn btn-primary">
                Save Bundle
            </button>

        </form>

    </div>

</div>

@endsection

@push('scripts')

<script>

$('#buyer_id').change(function(){

    let buyerId = $(this).val();

    $('#style_id').html('<option value="">Loading...</option>');

    if(buyerId == '')
    {
        $('#style_id').html('<option value="">Select Style</option>');
        return;
    }

    $.get('/buyers/' + buyerId + '/styles', function(styles){

        let option = '<option value="">Select Style</option>';

        $.each(styles,function(index,style){

            option += '<option value="'+style.id+'">'+style.style_no+'</option>';

        });

        $('#style_id').html(option);

    });

});

function calculate()
{
    let qty = parseFloat($('#quantity').val()) || 0;

    let completed = parseFloat($('#completed_qty').val()) || 0;

    let rejected = parseFloat($('#rejected_qty').val()) || 0;

    let balance = qty - completed - rejected;

    let efficiency = 0;

    let rejection = 0;

    if(qty > 0)
    {
        efficiency = (completed / qty) * 100;

        rejection = (rejected / qty) * 100;
    }

    $('#balance').val(balance);

    $('#efficiency').val(efficiency.toFixed(2)+' %');

    $('#rejection').val(rejection.toFixed(2)+' %');
}

$('#quantity,#completed_qty,#rejected_qty').on('keyup change',calculate);

// error message
$('#bundleForm').submit(function(e){

    e.preventDefault();

    $('.error-text').text('');

    let btn = $('#saveBtn');

    btn.prop('disabled',true);

    btn.text('Saving...');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url:"{{ route('bundles.store') }}",

        type:"POST",

        data:$(this).serialize(),

        success:function(response){

            Swal.fire({

                icon:'success',

                title:'Success',

                text:response.message

            });

            $('#bundleForm')[0].reset();

            calculate();

        },

        error:function(xhr){

            if(xhr.status==422){

                $.each(xhr.responseJSON.errors,function(key,value){

                    $('.'+key+'_error').text(value[0]);

                });

            }

        },

        complete:function(){

            btn.prop('disabled',false);

            btn.text('Save Bundle');

        }

    });

});

</script>

@endpush