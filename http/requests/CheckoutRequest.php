<?php namespace SublimeArts\SublimeStripe\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use SublimeArts\SublimeStripe\Models\Settings;
use RainLab\User\Facades\Auth;
use Stripe\Stripe;

class CheckoutRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'stripeEmail' => 'required|email',
            'stripeToken' => 'required',
            'product' => 'required'
        ];

    }

    /**
     * Handle the checkout data and create needed charges
     * @return [type] [description]
     */
    public function submit()
    {
        Stripe::setApiKey(Settings::get('stripe_secret_key'));
     
        $productModel = Settings::productModelClass();
        $product = $productModel::findOrFail($this->product['id']);

        $loggedUser = Auth::getUser()->user;

        $loggedUser->addSingleCharge($product, $this->stripeToken);
    }

}
