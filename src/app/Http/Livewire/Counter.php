<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Payment;

class Counter extends Component
{
    public $count = 10;
    public function inc()
    {
        $this->count++;
    }

    // public $selectedValue = ''; //選択された値
    // public $payments; //支払い方法一覧

    // public function mount($payments){
    //     $this->payments = $payments; //ビューから渡されたデータをセット
    // }
    // public function selectedValue($value)
    // {
    //     $this->selectedValue = $value;
    // }
    public function render()
    {
        return view('livewire.counter');
    }
}
