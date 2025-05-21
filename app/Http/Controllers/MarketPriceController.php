<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;
use App\Models\MarketPrice;
use Carbon\Carbon;

class MarketPriceController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function create()
    {
        return view('laravel_firebase.market_prices.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'market_location' => 'required|string|max:255',
            'date_recorded' => 'required|date',
        ]);

        // Save to local database
        $marketPrice = MarketPrice::create($validatedData);

        // Save to Firebase
        $this->saveToFirebase($marketPrice);

        return redirect()->route('market-price.create')
                        ->with('success', 'Market price saved successfully!');
    }



    protected function saveToFirebase(MarketPrice $marketPrice)
    {
        $database = $this->firebase->getDatabase();
        
        $newPost = $database
            ->getReference('market_prices')
            ->push([
                'item_name' => $marketPrice->item_name,
                'price' => $marketPrice->price,
                'market_location' => $marketPrice->market_location,
                'date_recorded' => $marketPrice->date_recorded,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
    }

    public function index()
    {
        $database = $this->firebase->getDatabase();
        $marketPrices = $database->getReference('market_prices')->getValue();

        return view('laravel_firebase.market_prices.index', compact('marketPrices'));
    }



    

    public function edit($firebaseKey)
    {
        try {
            $database = $this->firebase->getDatabase();
            $priceData = $database->getReference('market_prices/'.$firebaseKey)->getValue();
            
            if (!$priceData) {
                throw new \Exception('Price not found in Firebase');
            }
            
            return view('laravel_firebase.market_prices.edit', [
                'firebaseKey' => $firebaseKey,
                'priceData' => $priceData
            ]);
        } catch (\Exception $e) {
            return redirect()->route('market-price.index')
                ->with('error', 'Error: '.$e->getMessage());
        }
    }
    
    public function update(Request $request, $firebaseKey)
    {
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'market_location' => 'required|string|max:255',
            'date_recorded' => 'required|date',
        ]);
    
        try {
            $database = $this->firebase->getDatabase();
            $database->getReference('market_prices/'.$firebaseKey)->update([
                'item_name' => $validatedData['item_name'],
                'price' => $validatedData['price'],
                'market_location' => $validatedData['market_location'],
                'date_recorded' => $validatedData['date_recorded'],
                'updated_at' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('market-price.index')
                ->with('success', 'Market price updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating price: '.$e->getMessage());
        }
    }
    
    public function destroy($firebaseKey)
    {
        try {
            $database = $this->firebase->getDatabase();
            $database->getReference('market_prices/'.$firebaseKey)->remove();
    
            return redirect()->route('market-price.index')
                ->with('success', 'Market price deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting price: '.$e->getMessage());
        }
    }
}