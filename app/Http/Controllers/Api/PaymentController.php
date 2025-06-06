<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree\Gateway;
use App\Models\Order;
use App\Models\OrderedRequest;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $gateway;

    public function __construct()
    {
        // Configurazione del Gateway Braintree
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
        ]);

        Log::info('Braintree Gateway configurato correttamente.', [
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
        ]);
    }

    // Metodo per ottenere il client token
    public function getClientToken()
    {
        try {
            Log::info('Tentativo di generazione del client token.');
            $clientToken = $this->gateway->clientToken()->generate();
            Log::info('Client token generato con successo.');
            return response()->json(['clientToken' => $clientToken]);
        } catch (\Braintree\Exception\Authorization $e) {
            Log::error('Errore nella generazione del client token:', [
                'message' => $e->getMessage(),
            ]);
            return response()->json(['error' => 'Authorization error', 'message' => $e->getMessage()], 500);
        }
    }

    // Metodo per processare il pagamento
    public function processPayment(Request $request)
    {
        try {
            Log::info('Ricevuta richiesta per il pagamento:', $request->all());

            // Validazione dei dati
            $validated = $request->validate([
                'nonce' => 'required|string',
                'amount' => 'required|numeric',
                'name' => 'required|string',
                'email' => 'required|email',
                'telephone' => 'required|string',
                'cart' => 'required|array',
            ]);

            Log::info('Dati validati con successo:', $validated);

            // Log specifico per il nonce ricevuto
            Log::info('Nonce ricevuto per la transazione:', ['nonce' => $validated['nonce']]);

            // Conversione del totale in formato float e gestione arrotondamento a 2 decimali
            $validated['amount'] = round((float) $validated['amount'], 2);
            Log::info('Importo convertito in formato numerico e arrotondato:', ['amount' => $validated['amount']]);

            // Inizio transazione con Braintree
            Log::info('Inizio transazione con Braintree.', [
                'amount' => $validated['amount'],
                'nonce' => $validated['nonce'],
            ]);

            $result = $this->gateway->transaction()->sale([
                'amount' => $validated['amount'],
                'paymentMethodNonce' => $validated['nonce'],
                'options' => ['submitForSettlement' => true],
            ]);

            Log::info('Risultato della transazione con Braintree:', (array) $result);

            if ($result->success) {
                Log::info('Transazione completata con successo.', [
                    'transactionId' => $result->transaction->id,
                ]);

                // Creazione dell'ordine
                $order = Order::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'telephone' => $validated['telephone'],
                    'total_price' => $validated['amount'],
                    'restaurant_id' => $validated['cart'][0]['restaurant_id'],
                ]);

                Log::info('Ordine creato con successo:', $order->toArray());

                // Creazione dei dettagli dell'ordine
                foreach ($validated['cart'] as $item) {
                    OrderedRequest::create([
                        'order_id' => $order->id,
                        'dish_id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);

                    Log::info('Dettaglio ordine salvato:', [
                        'order_id' => $order->id,
                        'dish_id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'transactionId' => $result->transaction->id,
                    'order' => $order,
                ]);
            } else {
                Log::error('Errore durante la transazione Braintree:', [
                    'message' => $result->message,
                    'transaction' => $result->transaction ?? null,
                ]);
                return response()->json([
                    'success' => false,
                    'message' => $result->message,
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('Errore nel processamento del pagamento:', [
                'exception' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'error' => 'Payment processing error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
