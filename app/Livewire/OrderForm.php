<?php

namespace App\Livewire;

use App\Models\Shoe;
use App\Services\OrderService;
use Livewire\Component;

class OrderForm extends Component
{
    public Shoe $shoe;
    public $orderData;
    public $subTotalAmount;
    public $promoCode = null;
    public $promoCodeId = null;
    public $quantity = 1;
    public $discount = 0;
    public $grandTotalAmount = 0;
    public $totalDiscountAmount = 0;
    public $name;
    public $email;
    public $tax = 0;

    protected $orderService;

    public function boot(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function mount(Shoe $shoe, $orderData)
    {
        $this->shoe = $shoe;
        $this->orderData = $orderData;
        $this->subTotalAmount = $shoe->price;
        $this->grandTotalAmount = $shoe->price;
    }

    public function updatedQuantity()
    {
        $this->validateOnly(
            'quantity',
            [
                'quantity' => 'required|integer|min:1',
            ],
            [
                'quantity.max' => 'Stok Tidak Tersedia!',
            ]
        );


        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->subTotalAmount = $this->shoe->price * $this->quantity;
        $this->tax = ($this->subTotalAmount - $this->discount) * 0.11;
        $this->grandTotalAmount = ($this->subTotalAmount - $this->discount) + $this->tax;
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->shoe->stock) {
            $this->quantity++;
            $this->calculateTotal();
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->calculateTotal();
        }
    }

    public function updatedPromoCode()
    {
        $this->applyPromoCode();
    }

    public function applyPromoCode()
    {
        if (empty($this->promoCode)) {
            $this->resetDiscount();
            return;
        }

        $result = $this->orderService->applyPromoCode($this->promoCode, $this->subTotalAmount);

        if (isset($result['error'])) {
            session()->flash('error', $result['error']);
            $this->resetDiscount();
        } else {
            session()->flash('message', 'Kode promo berhasil diterapkan!');
            $this->discount = $result['discount'];
            $this->calculateTotal();
            $this->promoCodeId = $result['promoCodeId'];
            $this->totalDiscountAmount = $result['discount'];
        }
    }

    public function resetDiscount()
    {
        $this->discount = 0;
        $this->calculateTotal();
        $this->promoCodeId = null;
        $this->totalDiscountAmount = 0;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1|max:' . $this->shoe->stock,
        ];
    }

    protected function getherBookingData(array $validatedData)
    {
        return [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'quantity' => $validatedData['quantity'],
            'grand_total_amount' => $this->grandTotalAmount,
            'sub_total_amount' => $this->subTotalAmount,
            'discount' => $this->discount,
            'promo_code' => $this->promoCode,
            'promo_code_id' => $this->promoCodeId,
            'total_tax' => $this->tax,
        ];
    }

    public function submit()
    {
        $validated = $this->validate();
        $bookingData = $this->getherBookingData($validated);
        $this->orderService->updateCustomerData($bookingData);
        return redirect()->route('front.customer_data');
    }

    public function render()
    {
        return view('livewire.order-form');
    }
}