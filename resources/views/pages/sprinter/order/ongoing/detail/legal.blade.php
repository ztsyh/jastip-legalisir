@extends('pages.admin.pengajuan-legalisir.ijazah.detail.index')
@include('layouts.sprinter.script')
@section("payment")
@endsection
@section("actions")
    <div class="py-3">
        <form method="POST" action="{{route('sprinter.order.ongoing.legal.process',\Illuminate\Support\Facades\Route::current()->parameters)}}">
            @csrf
            <x-form.button isSubmit fullWidth type="{{\App\View\Components\Form\Button::TYPE_SUCCESS}}">
                {{__('messages.sprinter.form.submit.legal_process_done')}}
            </x-form.button>
        </form>
    </div>
@endsection
