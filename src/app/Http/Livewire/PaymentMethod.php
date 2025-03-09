<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;


class PaymentMethod extends Component
{
    public $payments;
    public $selectedValue = '';
    public $selectedPayment = '';
    public $profile;
    public $item;

    public function mount($id)
    {
        $this->payments = Payment::all();
        $this->profile = Address::where('user_id', Auth::id())->first();
        $this->item = Item::find($id);
    }
    public function updatedSelectedValue($value)
    {
        $payment = Payment::find($value);
        if ($payment) {
            $this->selectedPayment = $payment->content;
        } else {
            $this->selectedPayment = '未選択';
        }

        // $this->selectedPayment = $payment ? $payment->content : '未選択';
    }

    public function render()
    {
        return view('livewire.payment-method',['item' => $this->item]);
    }
}
