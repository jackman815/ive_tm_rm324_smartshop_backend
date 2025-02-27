@extends('_layout.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transactionManagement.remittance_transaction.title') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route("TransactionManagement.RemittanceTransactions.store") }}"
            enctype="multipart/form-data">
            @csrf
            <!-- -------------------transaction_id------------------- -->
            <div class="form-group">
                <label class="" for="transaction_id">{{ trans('cruds.fields.transaction_id') }}</label>
                <select class="form-control select {{ $errors->has('transaction_id') ? 'is-invalid' : '' }}"
                    name="transaction_id" id="transaction_id" >
                    <option value disabled {{ old('transaction_id', null) === null ? 'selected' : '' }}>
                        {{ trans('global.pleaseSelect') }}</option>
                    @foreach($transactions as $key => $transaction)
                    <option value="{{ $transaction->id }}"
                        {{ old('transaction_id') === $key ? 'selected' : '' }}>
                        {{ $transaction->id . $transaction->header }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('transaction_id'))
                <span class="text-danger">{{ $errors->first('transaction_id') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <!-- -------------------payee_id------------------- -->
            <div class="form-group">
                <label class="" for="payee_id">{{ trans('cruds.fields.payee_id') }}</label>
                <select class="form-control select {{ $errors->has('payee_id') ? 'is-invalid' : '' }}" name="payee_id"
                    id="payee_id" >
                    <option value disabled {{ old('payee_id', null) === null ? 'selected' : '' }}>
                        {{ trans('global.pleaseSelect') }}</option>
                    @foreach($users as $key => $user)
                    <option value="{{ $user->id }}" {{ old('payee_id') === $key ? 'selected' : '' }}>
                        {{ $user->id . $user->getFullNameAttribute() }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('payee_id'))
                <span class="text-danger">{{ $errors->first('payee_id') }}</span>
                @endif
                <span class="help-block"></span>
            </div>
            <!-- ---------------------------------------------------------------------- -->
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
