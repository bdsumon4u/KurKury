@extends('backend.layouts.app')

@section('content')

<style>
    @print {
        @page {
            margin:0;
            padding:0;
        }
		body{
			font-size: 0.875rem;
            font-weight: normal;
			padding:0;
			margin:0; 
		}
        .d-print-none,
        .aiz-topbar,
        .aiz-topbar-item,
        .aiz-main-content div:last-child {
            display: none !important;
            opacity: 0 !important;
        }
        .aiz-content-wrapper {
            padding: 0 !important;
        }
        .table td, .table th {
            padding: 0.5rem !important;
        }
    }
</style>

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
                    <th data-breakpoints="md">{{ translate('Note') }}</th>
                    <th data-breakpoints="md">{{ translate('Amount') }}</th>
                    <th data-breakpoints="md">{{ translate('D. Status') }}</th>
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
            $.get('{{ url()->current() }}', {code:code}, function(data) {
                if (! data.tr) {
                    return;
                }
                // remove tr.footable-empty
                $('.card-body table tbody tr.footable-empty').remove();
                // prepend data.tr to table tbody
                $('.card-body table tbody').prepend(data.tr);
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
            reCalculate();
        });

        function reCalculate() {
            var trows = $('table > tbody > tr');
            trows.each(function(i, tr) {
                $(tr).find('td:first-child').html(i+1);
            });

            var total_amount = 0;
            $('.card table tbody tr td:nth-child(5)').each((cell, el) => {
                return total_amount += new Number($(el).text().trim());
            });
            $('#aMount').text(total_amount);
        }
    });
</script>
@endsection