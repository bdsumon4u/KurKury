@extends('backend.layouts.app')

@section('content')

<div class="card">
    <div class="card-header row gutters-5 d-print-none">
        <div class="col">
            <div class="form-group mb-0">
                <form id="search-form" action="" onsubmit="return false">
                    <input type="text" class="form-control" id="search" name="code" value="{{ request('code') }}" placeholder="{{ translate('Scan Code(s)') }}" autofocus>
                </form>
            </div>
        </div>
        <div class="col-auto">
            <div class="form-group mb-0">
                <button onclick="print()" class="btn btn-primary">{{ translate('Print') }}</button>
            </div>
        </div>
    </div>

    <div class="card-body p-1">
        <table class="table -aiz-table mb-0 table-bordered">
            <thead>
                <tr>
                    <th>{{ translate('S.I.') }}</th>
                    <th>{{ translate('Code') }}</th>
                    <th data-breakpoints="md">{{ translate('Customer') }}</th>
                    <th data-breakpoints="md">{{ translate('Amount') }}</th>
                    <th data-breakpoints="md">{{ translate('D. Status') }}</th>
                    <th data-breakpoints="md">{{ translate('P. Method') }}</th>
                    <th data-breakpoints="md">{{ translate('P. Status') }}</th>
                    <th class="d-print-none">{{ translate('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
    <div class="card-footer p-1">
        <h4 class="my-1">Total Amount: <span id="aMount"></span></h4>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#search-form').on('submit', function (ev) {
            ev.preventDefault();
            var code = $('#search').blur().val();

            var trLength = $('.card-body table tbody tr:not(.footable-empty)').length;
            $.get('{{ url()->current() }}', {code:code, si: trLength+1}, function(data) {
                if (! data.tr) {
                    return;
                }
                // remove tr.footable-empty
                $('.card-body table tbody tr.footable-empty').remove();
                // append data.tr to table tbody
                $('.card-body table tbody').append(data.tr);
                // fooTable
                // AIZ.plugins.fooTable();
                $('#search').focus().val('');
                reCalculate();
            });

            return false;
        });

        $(document).on('click', '.btn-soft-danger', function(ev) {
            ev.preventDefault();
            $(this).closest('tr').remove();
            $('table > tbody > tr').each(function(i, tr) {
                $(tr).find('td:first-child').html(i+1);
            });
            reCalculate();
        });

        function reCalculate() {
            var total_amount = 0;
            $('.card table tbody tr td:nth-child(4)').each((cell, el) => {
                return total_amount += new Number($(el).text().trim());
            });
            $('#aMount').text(total_amount);
        }
    });
</script>
@endsection