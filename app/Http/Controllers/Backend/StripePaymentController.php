<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Stripe;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Invoice\Models\Invoice;
use Stripe\Exception\InvalidRequestException;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request, $invoice_id): View
    {
        $invoice = Invoice::find($invoice_id);
        if (empty($invoice)) {
            return response()->json(['errors' => 'invoice not found'], 422);
        }

        return view('backend.stripe', compact('invoice'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request): RedirectResponse
    {
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $response = Stripe\Charge::create([
                'amount' => 10 * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Test payment from itsolutionstuff.com.',
            ]);

            if ($response['status'] == 'succeeded') {
                $invoice = Invoice::find($request->invoice_id);
                $invoice->status = 'Paid';
                $invoice->transaction = json_encode($response);
                $invoice->save();
                session()->flash('success', 'Payment successful!');
            } else {
                session()->flash('error', 'Something went wrong');
            }
        } catch (InvalidRequestException $e) {
            session()->flash('error', 'The Stripe token has already been used. Please refresh the page and try again with a new token.');
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while processing the payment. Please try again later.');
        }
        return redirect()->back();
    }
}
