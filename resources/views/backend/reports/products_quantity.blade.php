@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class=" align-items-center">
       <h1 class="h3">{{translate('Product quantity sale report')}}</h1>
	</div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <form>
                <div class="card-header row gutters-5">
                    <div class="col-lg-3">
                        <div class="form-group mb-0">
                            <input type="date" class="form-control" value="{{ request('date', date('Y-m-d')) }}" name="date" placeholder="{{ translate('Date') }}" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-3 ml-auto">
                        <select class="form-control aiz-selectpicker" name="status" id="status">
                            <option value="">{{translate('D. Status')}}</option>
                            <option value="pending" @if (request('status') == 'pending') selected @endif>{{translate('Pending')}}</option>
                            <option value="confirmed" @if (request('status') == 'confirmed') selected @endif>{{translate('Confirmed')}}</option>
                            <option value="picked_up" @if (request('status') == 'picked_up') selected @endif>{{translate('Picked Up')}}</option>
                            <option value="on_the_way" @if (request('status') == 'on_the_way') selected @endif>{{translate('On The Way')}}</option>
                            <option value="delivered" @if (request('status') == 'delivered') selected @endif>{{translate('Delivered')}}</option>
                            <option value="cancelled" @if (request('status') == 'cancelled') selected @endif>{{translate('Cancel')}}</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
                        </div>
                    </div>
                </div>
            </form>
            
            <!--card body-->
            <div class="card-body">
                <table class="table table-bordered aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Product Name') }}</th>
                            <th>{{ translate('Quantity') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($products as $product => $quantity)
                            @php $total += $quantity; @endphp
                            <tr>
                                <td>{{ $product }}</td>
                                <td>{{ $quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total</th>
                            <th>{{ $total }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
